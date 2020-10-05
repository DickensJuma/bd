<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\order;
use App\Shipment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReportsController extends Controller
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


    public function shoppingReports(Request $request)
    {
        $this->validate($request, [
            'fromDate' => 'required',
            'toDate'=> 'required',
            'shop' => 'required'
        ]);

        $orders = Shipment::where('seller_id',$request->shop)->whereBetween('created_at', [$request->fromDate, $request->toDate])->with(['order','order.coupon','order.customer'])->get();

        if (count($orders) < 1){
            throw ValidationException::withMessages(['no_data' => 'Sorry! No data found']);
        }

        return $orders;
    }
    public function RetailerShoppingReports(Request $request)
    {
        $this->validate($request, [
            'fromDate' => 'required',
            'toDate'=> 'required',
        ]);

        $userId = auth()->user()->id;

        $orders = Shipment::where('seller_id', $userId)->whereBetween('created_at', [$request->fromDate, $request->toDate])->with(['order','order.coupon','order.customer'])->get();

        if (count($orders) < 1){
            throw ValidationException::withMessages(['no_data' => 'Sorry! No data found']);
        }

        return $orders;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
