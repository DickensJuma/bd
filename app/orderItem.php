<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderItem extends Model
{
    protected $table = "order_items";

    public function order(){
        return $this->belongsTo(order::class, 'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function deliveries(){
        return $this->hasOne(Delivery::class, 'shipping_id');
    }

}
