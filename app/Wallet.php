<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public function rider(){
        return $this->belongsTo(User::class, 'rider_id');
    }
}
