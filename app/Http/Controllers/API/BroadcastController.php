<?php

namespace App\Http\Controllers\API;

use App\Events\DialRider;
use App\FcmToken;
use App\Helpers\FCM\RiderNotification;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\User;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function getRiders()
    {
        return User::where('role', 'rider')->orderBy('name')->with(array("ride" => function ($q) {
            $q->where('verification', 'verified');
        }))->get(['id', 'name', 'phone']);
    }

    public function dialARider(Request $request, $id){
        $this->validate($request, [
            'rider' => 'required'
        ]);

        $shipping = Shipment::where('shipmentId', $id)->with(['orderItems'])->firstOrFail();
        $shipping->dialed_rider_id = $request->rider['id'];
        $shipping->update();

        broadcast(new DialRider($shipping));

        $rider = FcmToken::latest()->where('rider_id', $request->rider['id'])->first();
        $message = 'Shipment ID: ' . $shipping->shipmentId;

        $response = RiderNotification::send_notification($rider->token, $message, $shipping);

        return response()->json([
            "message" => "success",
            "data" => $response
        ], 200);
    }
}
