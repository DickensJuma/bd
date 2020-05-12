<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    protected $fillable = [
        'user_id', 'vehicle_type', 'id_no', 'area_of_operation'
    ];

    public function rider(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
