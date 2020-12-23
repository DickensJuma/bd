<?php


namespace App\Helpers\VasSms;


use Illuminate\Support\Facades\Http;

class Vas
{
  public static function send_sms($phone, $message){
      $email = 'info@twtechnologies.africa';
      $sender = 'TRANSMALL';
      $data = array(
          "email" => $email,
          "sender" => $sender,
          "sms" => [[
              "requestid" => 123,
              "msisdn" => $phone,
              "message" => $message,
          ]],
      );
      $response = Http::withHeaders([
          'Accept' => 'application/json',
          'Content-Type' => 'application/json',
          'api_key' => env('VAS_API_KEY')
      ])->post('https://vas2.standardmedia.co.ke/api/sendmessages', $data);

          return $response;
  }
}
