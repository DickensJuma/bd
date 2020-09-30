<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
