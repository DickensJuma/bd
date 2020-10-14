<?php

namespace App\Http\Controllers\API;

use App\Events\DialNearbyRiders;
use App\Events\DialRider;
use App\FcmToken;
use App\Helpers\FCM\RiderNotification;
use App\Http\Controllers\Controller;
use App\LocationTracking;
use App\Shipment;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function getRiders()
    {
        return User::where('role', 'rider')->orderBy('name')->with(array("ride" => function ($q) {
            $q->where('verification', 'verified');
        }))->get(['id', 'name', 'phone']);
    }

    public function dialARider(Request $request, $id)
    {
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

    public function dialNearbyRiders($shipmentId)
    {
        $loc = new LocationTracking;
        $query = ($loc)->newQuery();
        $shipment = Shipment::findOrFail($shipmentId);

        // get riders with their last location recorded
        $query->where('created_at', '>', Carbon::now()->subHours(1)->toDateTimeString());

        // get riders within 5km radius of the customer
        $query->distanceSphereExcludingSelf('location', $shipment->location, 5000);

        // Select unique user
        $query->select('user_id')->distinct();

        $riders = $query->get();

        if (!count($riders)) {
            return response()->json([
                'msg' => 'No nearby riders available',
                'success' => false
            ], 404);
        }

        $riders->map(function ($item, $key) use ($shipment) {
            $rider = User::findOrFail($item->user_id);
            $rider->shipments()->attach($shipment->id);

            $token = FcmToken::latest()->where('rider_id', $rider->id)->first();
            $message = 'Shipment ID: ' . $shipment->shipmentId;

            RiderNotification::send_notification($token->token, $message, $shipment);
        });

        $data = array(
            'riders' => $riders,
            'shipment' => $shipment
        );

        broadcast(new DialNearbyRiders($data));

        return response()->json([
            'msg' => count($riders) . ' rider(s) dialed!',
            'status' => true
        ], 200);
    }
}
