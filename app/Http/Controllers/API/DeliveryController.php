<?php

namespace App\Http\Controllers\API;

use App\Delivery;
use App\Http\Controllers\Controller;
use App\order;
use App\User;
use Illuminate\Http\Request;

/**
 * @group  Delivery
 *
 * APIs for Managing Delivery of Items
 */
class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Delivery::where('Rider_id', auth()->user()->id)->with('order')->get();
    }
    public function getShop($id){

    }
    public function rider($id)
    {
        $order_id = order::where('orderNo', $id)->value('id');
        $user_id = Delivery::where('Order_id', $order_id)->with('rider')->get();
        return  $user_id;
    }

    public function myRider(Request $request,$id){
        $order_id = order::where('orderNo',$id)->value('id');
         $rider = Delivery::where('Order_id', $order_id)->firstOrFail();
         $rider->Rider_id = $request->rider;
         $rider->update();

         return response([
             'status' => 'success'
         ], 200);
     }
     public function shopInfo($id)
    {
        return order::where('orderNo', $id)->with('items.product.files')->with('customer')->with('coupon')->firstOrFail();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'rider' => 'required|integer',
            'shipping' =>'required|integer'
        ]);
        $customer_id = order::where('orderNo', $id)->value('customer_id');
        $order_id = order::where('orderNo', $id)->value('id');
        $delivery = new Delivery();
        $delivery->Rider_id = $request->rider;
        $delivery->Customer_id = $customer_id;
        $delivery->Order_id = $order_id;
        $delivery->shipping_id =$request->shipping;
        $delivery->status = "in-transit";
        $delivery->save();

       /* $order = order::where('orderNo', $id)->firstOrFail();
        $order->status = "in-transit";
        $order->update();*/

        return response([
            'status' => 'success'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
