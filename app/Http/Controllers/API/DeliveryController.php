<?php

namespace App\Http\Controllers\API;

use App\Delivery;
use App\Http\Controllers\Controller;
use App\order;
use App\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
     public function rider($id){
        $order_id = order::where('orderNo', $id)->value('id');
        $user_id = Delivery::where('Order_id',$order_id)->value("Rider_id");
        return User::where('id',$user_id)->with('ride')->firstOrFail();
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'rider' =>'required|integer'
        ]);
        $customer_id  = order::where('orderNo',$id)->value('customer_id');
        $order_id = order::where('orderNo',$id)->value('id');
        $delivery = new Delivery();
        $delivery->Rider_id = $request->rider;
        $delivery->Customer_id =$customer_id;
        $delivery->Order_id = $order_id;
        $delivery -> save();

        $order = order::where('orderNo', $id)->firstOrFail();
        $order->status = "in-transit";
        $order->update();

        return response([
            'status' => 'success'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
