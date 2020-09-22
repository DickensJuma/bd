<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Coupon;
use App\Events\NewShipping;
use App\FcmToken;
use App\Helpers\FCM\RiderNotification;
use App\Helpers\Payment\Mpesa;
use App\Http\Controllers\Controller;
use App\order;
use App\orderItem;
use App\Product;
use App\Shipment;
use Illuminate\Http\Request;
use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function MyOrders()
    {

        return Shipment::latest()->with(array("orderItems.product" => function ($q) {
            $q->where('user_id', auth()->user()->id);
        }))->with(['order.customer', 'orderItems.product.files'])->where('seller_id', auth()->user()->id)->get();
    }

    public function orderDetail($id)
    {
        $productId = orderItem::where('id', $id)->value('product_id');
        return Product::where('id', $productId)->with(array('category' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('brand' => function ($query) {
            $query->select('id', 'name');
        }))->with(array('subcategory' => function ($query) {
            $query->select('id', 'name');
        }))->get(['id', 'title', 'price', 'category_id', 'brand_id', 'sub_category_id', 'uniqueId', 'status']);
    }

    public function showOrderDetails($id)
    {
        $order_id = orderItem::where('id', $id)->value('order_id');
        return order::where('id', $order_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'total_price' => 'required|integer',
            'phone' => 'required|phone:KE|min:10',
            'cart' => 'required'
        ]);
        \DB::transaction(function () use ($request) {
            $order = new order();
            if ($request->coupon_unique_id) {
                $coupon = Coupon::where('unique_id', $request->coupon_unique_id)->firstOrFail();
                $order->coupon_id = $coupon['id'];
                $discount = $coupon->discount($request->total_price);
                $order->discount = $discount;
                $order->sub_total = $request->total_price - $discount;
            }

            $order->deliver = $request->deliver;
            $order->customer_id = Auth::user()->id;
            $order->orderNo = Auth::user()->id . time();
            $order->total_price = $request->total_price;
            if (!$request->coupon_unique_id) {
                $order->sub_total = $request->total_price;
            }
            $order->phone = $request->phone;
            $order->county = $request->county;
            $order->longitude = $request->longitude;
            $order->latitude = $request->latitude;
            $order->address = $request->address;
            $order->LocationName = $request->LocationName;
            $order->save();

            $sellers_ids = collect($request->cart)->pluck("product.user_id");
            $shops = array_unique($sellers_ids->toArray());

            foreach ($shops as $id) {
                $shipmentNo = substr(md5(time() . $id), 0, 10);
                $shipment = new Shipment();
                $shipment->order_id = $order->id;
                $shipment->shipmentId = strtoupper($shipmentNo);
                $shipment->status = 'new';
                $shipment->seller_id = $id;
                $shipment->deliveryFee = 100;
                $shipment->save();
                $total = 0;

                foreach ($request->cart as $item) {
                    if ($item['product']['user_id'] == $id) {
                        $orderItem = new orderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->product_id = $item['product']['id'];
                        $orderItem->quantity = $item['quantity'];
                        $orderItem->shipment_id = $shipment->id;
                        $orderItem->price = $item['product']['price'];
                        $orderItem->save();
                        $total += $item['product']['price'];
                    }
                }
                $shipment->total = $total;
                $shipment->update();
                broadcast(new NewShipping($shipment));
            }

            // Pay
            $phoneNo = '254' . substr($request->phone, -9);
            $trans_id = $order->orderNo; // unique id
            $customer_id = $order->customer_id; // user id
            $amount = (int)$order->sub_total; //  amount to pay. Must be int
            $service_id = '1'; // type of service e.g 1- advertisement, 2- booking
            Mpesa::stk_push($trans_id, $customer_id, $phoneNo, $amount, $service_id);
        });

        return response()->json([
            "message" => "success"
        ], 200);
    }

    public function makePayment(Request $request, $id)
    {
        $this->validate($request, [
            'phone' => 'required|phone:KE|min:10',
        ]);
        $order = order::firstWhere('orderNo', $id);

        $phoneNo = '254' . substr($request->phone, -9);
        $trans_id = $id; // unique id
        $customer_id = $order->customer_id; // user id
        $amount = (int)$order->sub_total; //  amount to pay. Must be int
        $service_id = '1'; // type of service e.g 1- advertisement, 2- booking
        Mpesa::stk_push($trans_id, $customer_id, $phoneNo, $amount, $service_id);

        return response()->json([
            "Message" => "Success"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function showAll(order $order)
    {
        $order = new order();
        return response($order::latest()->with('items')->with('customer')->get());
    }

    public function show(order $order)
    {
        $order = new order();
        $id = Auth::user()->id;
        return response($order::latest()->where('customer_id', $id)->get());
    }
    public function comment(Request $request,$id)
    {
        $this->validate($request,[
           'shipmentNo' => 'required|integer',
            'comment'=>'required|string'
        ]);
        $orderId = order::where('orderNo',$id)->value('id');
        $comment = new Comment();
        $comment ->orderNo = $orderId;
        $comment->shipmentId = $request->shipmentNo;
        $comment->userId = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->status = 'New';
        $comment->save();
        return response()->json([
            "Message" => "Success"
        ], 200);
    }
    public function showShipment($id)
    {
        $order_id = order::where('orderNo', $id)->value('id');
        return orderItem::where('order_id', $order_id)->with("product")->with('deliveries')->with('product.files')->get()->groupBy('shipment_id');
    }

    public function showDetails($id)
    {
        if (Auth::user()->role == 'customer') {
            return order::where('orderNo', $id)->with('items.product.files')->with('coupon')->firstOrFail();
        }

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'stock-manager') {
            return order::where('orderNo', $id)->with('items.product.files')->with('customer')->with('coupon')->firstOrFail();
        }
    }

    public function shipment($id)
    {
        $order_id = order::where('orderNo', $id)->value('id');
        return orderItem::where('order_id', $order_id)->with("product")->with('deliveries')->with('product.files')->get()->groupBy('shipment_id');
    }

    public function changeStatus(Request $request, $id)
    {
        $order = order::where('orderNo', $id)->firstOrFail();
        $order->status = $request->status;
        $order->update();

        return response([
            'status' => 'success'
        ], 200);
    }

    public function cancelOrder($id)
    {
        $order = order::where('orderNo', $id)->firstOrFail();
        $order->status = 'cancelled';
        $order->update();

        return response([
            'status' => 'success'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
