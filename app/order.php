<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    public function items(){
        return $this->hasMany(orderItem::class, 'order_id');
    }
    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function mpesa_wallet(){
        return $this->hasOne(MpesaWallet::class, 'order_id');
    }
}
