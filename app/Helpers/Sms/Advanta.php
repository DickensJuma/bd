<?php

namespace App\Helpers\Sms;

class Advanta
{
    /**
     * @param int $user_id User-id
     *
     * @return string
     */

    public static function send_sms($phone, $message)
    {

        $partnerID = env('ADVANTA_PARTNER_ID');
        $apikey = env('ADVANTA_API_KEY');
        $shortcode = env('ADVANTA_SENDER_ID');

        $endpoint_url = env('ADVANTA_API_URL') . "/api/services/sendsms/?apikey=" . urlencode($apikey) . "&partnerID=" . urlencode($partnerID) . "&message=" . urlencode($message) . "&shortcode=$shortcode&mobile=$phone";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}