<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Shipment;
use App\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function walletBalance()
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'data' => $user->wallet()->exists() ? $user->wallet->balance : "0.0"
        ], 200);
    }

    public function walletTransactions()
    {
        $user = auth()->user();

        return WalletTransaction::latest()->where('rider_id', $user->id)->with(array('shipment' => function ($query) {
            $query->select('id', 'shipmentId');
        }))->paginate(10);
    }

    public function stats()
    {
        $user = auth()->user();
        $total = Shipment::where('rider_id', $user->id)->count();
        $complete = Shipment::where('rider_id', $user->id)->where('status', 'complete')->count();
        $data = array(
            'total' => $total,
            'complete' => $complete
        );

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function earningReport()
    {
        return WalletTransaction::where('type', 'ride-complete')->whereYear('created_at', date('Y'))->select(
            DB::raw('sum(amount) as sum'),
            DB::raw("DATE_FORMAT(created_at,'%M') as month")
        )->groupBy('month')->get();
    }
}
