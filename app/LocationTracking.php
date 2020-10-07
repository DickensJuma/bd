<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class LocationTracking extends Model
{
    use SpatialTrait;

    protected $spatialFields = [
        'location',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
