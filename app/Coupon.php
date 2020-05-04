<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code)
    {
        return self::where('code', $code)->where('status', 'active')->first();
    }

    public function discount($total, $id)
    {
        $coupon = self::where('id', $id)->where('status', 'active')->firstOrFail();
        if ($total > $coupon['goods_worth']) {
            if ($coupon['type'] == 'fixed') {
                return $coupon['value'];
            } elseif ($coupon['type'] == 'percent') {
                $final = ($coupon['percent_off'] / 100) * $total;
                return $final;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
