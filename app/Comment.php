<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function order(){
        return $this->belongsTo(order::class, 'orderNo');
    }
    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }
}
