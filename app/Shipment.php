<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    public function order(){
        return $this->belongsTo(order::class, 'order_id');
    }

    public function orderItems(){
        return $this->hasMany(orderItem::class, 'shipment_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
