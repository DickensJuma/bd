<?php

namespace App\Helpers\Payment;

class Mpesa
{
    /**
     * @param int $user_id User-id
     *
     * @return string
     */

    public static function get_accesstoken()
    {

        $credentials = base64_encode(env('CONSUMER_KEY') . ':' . env('CONSUMER_SECRET'));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials, 'Content-Type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        $access_token = $response->access_token;

        // The above $access_token expires after an hour, find a way to cache it to minimize requests to the server
        if (!$access_token) {
            throw new Exception("Invalid access token generated");
            return false;
        }
        return $access_token;
    }

    public static function submit_request($endpoint_url, $json_body)
    { // Returns cURL response
        $access_token = self::get_accesstoken();

        if ($access_token != '' || $access_token !== false) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $endpoint_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json_body);

            $response = curl_exec($curl);
            curl_close($curl);

            return $response;

        } else {
            throw new Exception("Access token is invalid");
            return false;
        }
    }

    public static function stk_push($trans_id, $user_id, $msisdn, $amount, $service_id)
    {
        $data = array(

            'BusinessShortCode' => env('LNM_SHORTCODE'),
            'Password' => base64_encode(env('LNM_SHORTCODE') . env('LNM_KEY') . date('YmdHis')),
            'Timestamp' => date('YmdHis'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $msisdn,
            'PartyB' => env('LNM_SHORTCODE'),
            'PhoneNumber' => $msisdn,
            'CallBackURL' => env('MPESA_WEBHOOK_URL') . '/api/v1/mpesa-callback/' . $trans_id . '/' . $user_id . '/' . $service_id . '/' . $msisdn . '/' . $amount,
            'AccountReference' => $trans_id,
            'TransactionDesc' => 'Zentamall Buy Goods Payment',
        );

        $data = json_encode($data);
        $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $response = self::submit_request($url, $data);
        return $response;

    }

    public static function register_url()
    {
        $request_data = array(
            'ShortCode' => env('LNM_SHORTCODE'),
            'ResponseType' => 'Completed',
            'ConfirmationURL' => env('MPESA_WEBHOOK_URL') . '/callback-c2b',
            'ValidationURL' => env('MPESA_WEBHOOK_URL') . '/callback-c2b',
        );
        $data = json_encode($request_data);
        $url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';
        $response = self::submit_request($url, $data);
        return $response;
    }

    public static function account_balance()
    {

        $data = array(

            'Initiator' => env('C2B_INITIATOR'),
            'SecurityCredential' => env('C2B_SECURITY_CREDENTIAL'),
            'CommandID' => 'AccountBalance',
            'PartyA' => env('LNM_SHORTCODE'),
            'IdentifierType' => '4',
            'AccountType' => '4',
            'Remarks' => 'Check balance',
            'QueueTimeOutURL' => env('MPESA_WEBHOOK_URL') . '/account-balance',
            'ResultURL' => env('MPESA_WEBHOOK_URL') . '/account-balance',
        );

        $data = json_encode($data);
        $url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
        $response = self::submit_request($url, $data);
        return $response;
    }

}
