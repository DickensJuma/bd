<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public static function findByCode($code)
    {
        return self::where('code', $code)->where('status', 'active')->first();
    }

    public function discount($total)
    {
        if ($total > $this->goods_worth) {
            if ($this->type == 'fixed') {
                return $this->value;
            } elseif ($this->type == 'percent') {
                $final = ($this->percent_off / 100) * $total;

                return $final;
            } else {
                return 0;
            }
        }else{
            return 0;
        }
    }
}
