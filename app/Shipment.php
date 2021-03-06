<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;


class Shipment extends Model
{
    use SpatialTrait;

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

    protected $spatialFields = [
        'location',
    ];

    public function riders()
    {
        return $this->belongsToMany(User::class, 'shipments_users', 'shipment_id',
            'user_id');
    }
}
