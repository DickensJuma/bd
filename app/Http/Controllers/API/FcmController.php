<?php

namespace App\Http\Controllers\API;

use App\FcmToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function saveToken(Request $request)
    {
        if ($request->app == 1) {
            $token = new FcmToken();
            $token->id = $request->userId;
            $token->token = $request->token;
            $token->save();

            return response()->json([
                'success' => true,
                "message" => "success"
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Unauthorised',
        ], 403);
    }
}
