<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\RideComment;
use App\Shipment;
use App\User;
use App\Wallet;
use App\WalletTransaction;
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
        $user = auth()->user();
        $shipments_nearby = $user->shipments;
        $shipments_assigned = Shipment::latest()->where('dialed_rider_id', $user->id)->whereNull('rider_id')
            ->where('dialed_to_nearby_riders', 0)->get();

        $shipments = $shipments_nearby->merge($shipments_assigned)->all();

        return response()->json([
            "message" => "success",
            "res" => $shipments
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);
        $user = auth()->user();

        $intransit = Shipment::where('rider_id', $user->id)->where('status', 'in-transit')->count();

        if ($intransit > 0){
            return response()->json([
                'success' => false,
                'message' => 'Please complete your pending rides to take another ride',
            ], 403);
        }

        if (!is_null($shipment->rider_id)) {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function myRides()
    {
        $user = auth()->user();
        return Shipment::latest()->where('rider_id', $user->id)->paginate(4);
    }

    public function completeRide($shipmentId)
    {
        $shipment = Shipment::findOrFail($shipmentId);
        $user = auth()->user();

        if ($user->id != $shipment->rider_id){
            return response()->json([
                'success' => false,
                'message' => 'Not your ride',
            ], 403);
        }

        \DB::transaction(function () use ($shipment) {
            $shipment->status = 'complete';
            $shipment->update();

            $rider = User::findOrFail($shipment->rider_id);

            if ($rider->wallet()->exists()) {
                $rider->wallet->balance += $shipment->deliveryFee;
                $rider->wallet->update();
            } else {
                $wallet = new Wallet();
                $wallet->rider_id = $shipment->rider_id;
                $wallet->balance = $shipment->deliveryFee;
                $wallet->save();
            }

            $walletTransaction = new WalletTransaction();
            $walletTransaction->rider_id = $shipment->rider_id;
            $walletTransaction->amount = $shipment->deliveryFee;
            $walletTransaction->shipment_id = $shipment->id;
            $walletTransaction->type = 'ride-complete';
            $walletTransaction->wallet_balance = $rider->wallet->balance;
            $walletTransaction->save();
        });

        return response()->json([
            "success" => true,
        ], 200);
    }

    public function commentRide(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|string',
        ]);

        if ($request->app != 1){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised',
            ], 403);
        }

        $shipment = Shipment::findOrFail($id);

        if ($shipment->status == 'in-transit'){
            return response()->json([
                'success' => false,
                'message' => 'Please complete ride to add comment',
            ], 400);
        }

        $ride_comment = new RideComment();
        $ride_comment->comment = $request->comment;
        $ride_comment->shipment_id = $id;
        $ride_comment->user_id = auth()->user()->id;
        $ride_comment->save();

        return response()->json([
            "success" => true,
            "message" => "Comment posted successfully"
        ], 200);
    }

    public function getRideComments($id)
    {
        return RideComment::latest()->where('shipment_id', $id)->with(array('user' => function ($query) {
            $query->select('id', 'name');
        }))->paginate(7);
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
