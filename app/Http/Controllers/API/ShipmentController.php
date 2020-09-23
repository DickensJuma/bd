<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $shipments =  Shipment::latest()->where('dialed_rider_id', auth()->user()->id)->whereNull('rider_id')->get();

        return response()->json([
            "message" => "success",
            "res" => $shipments
        ], 200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $shipment = Shipment::with(['order.items.product.files', 'order.customer', 'seller'])->findOrFail($id);

        return response()->json([
            "success" => true,
            "data" => $shipment
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);

        if (!is_null($shipment->rider_id)){
            return response()->json([
                'success' => false,
                'message' => 'You are late! Ride already taken',
            ], 403);
        }

        $shipment->rider_id = auth()->user()->id;
        $shipment->status = 'in-transit';
        $shipment->update();

        return response()->json([
            "success" => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myRides()
    {
        $user = auth()->user();
        return Shipment::latest()->where('rider_id', $user->id)->paginate(10);
    }

    public function clearShipments()
    {
        $ships = Shipment::all();

        $ships->map(function ($item, $key) {
            $item->dialed_rider_id = null;
            $item->status = 'new';
            $item->rider_id = null;
            $item->update();
        });

        return response()->json([
            "success" => true,
        ], 200);
    }
}
