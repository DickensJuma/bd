<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function customer(){
        return $this->belongsTo(User::class, 'Customer_id');
    }
    public function rider(){
        return $this->belongsTo(User::class, 'Rider_id');
    }
    public function order(){
        return $this->belongsTo(User::class, 'Order_id');
    }
}
