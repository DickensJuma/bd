<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MpesaWallet extends Model
{
    protected $table = 'mpesa_wallet';

    protected $fillable = [
        'trans_id', 'user_id', 'order_id', 'service_id', 'phone', 'amount', 'receipt_number', 'transaction_date',
    ];

    public function order(){
        return $this->belongsTo(order::class, 'order_id');
    }
}
