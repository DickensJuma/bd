<?php

namespace App\Http\Controllers\API;

use App\Events\DialRider;
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

        return response()->json([
            "message" => "success"
        ], 200);
    }
}
