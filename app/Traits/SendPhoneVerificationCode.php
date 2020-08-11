<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SendPhoneVerificationCodeTrait
{
    public function sendPhoneVerificationCode($phone, $code)
    {
        $data = array(
            "transactional" => [[
                "requestID" => 1234,
                "msisdn" => $phone
            ]],
            "message" => "Your Transmall verification code is " . $code,
            "username" => env("VAS_USERNAME"),
            "password" => env("VAS_PASSWORD")
        );
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post('https://vas.standardmedia.co.ke/api/sms2', $data);

        if ($response->ok()){
            return response()->json([
                'status' => 'success',
            ], 200);
        }
    }
}
