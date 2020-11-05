<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\LocationTracking;
use Illuminate\Http\Request;
use Auth;

/**
 * @group  Location Tracking
 *
 * APIs for Controlling Riders Location
 */
class LocationTrackingController extends Controller
{
    public function CreateLocation(Request $request)
    {
        if ($request->app == 1) {
            $this->validate($request, [
                'longitude' => 'required',
                'latitude' => 'required',
            ]);

            $newLocation = new LocationTracking();
            $newLocation->user_id = Auth::user()->id;;
            $newLocation->longitude = $request->longitude;
            $newLocation->latitude = $request->latitude;
            $newLocation->save();

            return response()->json([
                'msg' => 'added successfully',
                'success' => true
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorised',
        ], 403);
    }
}
