<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WholesalerRetailer extends Model
{
    protected $appends = ['filePath'];

    public function getFilePathAttribute()
    {
        return asset('img/profiles/' . $this->profile_image);
    }
}
