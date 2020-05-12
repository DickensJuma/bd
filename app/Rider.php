<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    public function rider(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
