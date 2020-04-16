<?php

namespace App\Helpers\Logger;

use App\RequestLog;

class Logger
{
    /**
     * @param int $user_id User-id
     *
     * @return string
     */

    public static function log_request($trans_id, $user_id, $phone, $amount, $merchant_id, $checkout_id, $status, $description)
    {
        $log = new RequestLog();
        $log->trans_id = $trans_id;
        $log->user_id = $user_id;
        $log->phone = $phone;
        $log->amount = $amount;
        $log->merchant_request_id = $merchant_id;
        $log->checkout_request_id = $checkout_id;
        $log->result_code = $status;
        $log->result_desc = $description;

        return $log->save();
    }

}