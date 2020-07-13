<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiderDocs extends Model
{
    public function docs(){
        return $this->belongsTo(User::class, 'rider_id');
    }
    protected $appends = ['filePath'];

    public function getFilePathAttribute()
    {
        return url(asset('/storage/uploads/' . $this->filename));
    }
}
