<?php


namespace App\Helpers\VasSms;


use Illuminate\Support\Facades\Http;

class Vas
{
  public static function send_sms($phone, $message){
      $username = env("VAS_USERNAME");
      $password = env("VAS_PASSWORD");
      $data = array(
          "transactional" => [[
              "requestID" => 1,
              "msisdn" => $phone
          ]],
          "message" => $message,
          "username" => $username,
          "password" => $password
      );
      $response = Http::withHeaders([
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
      ])->post('https://vas.standardmedia.co.ke/api/sms2', $data);

          return $response;
  }
}
