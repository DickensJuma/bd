<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\WalletTransaction;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function walletBalance()
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'data' => $user->wallet()->exists() ? $user->wallet->balance : 0
        ], 200);
    }

    public function walletTransactions()
    {
        $user = auth()->user();

        return WalletTransaction::latest()->where('rider_id', $user->id)->paginate(10);
    }
}
