<?php

namespace App\Http\Controllers\API;

use App\Helpers\VasSms\Vas;
use App\Http\Controllers\Controller;
use App\Shipment;
use App\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

/**
 * @group  Wallet
 *
 * APIs for Managing Wallet transaction
 */
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

    public function earningReport(Request $request)
    {
        $year = $request->query('year');
        $data = WalletTransaction::where('rider_id', auth()->user()->id)->where('type', 'ride-complete')->whereYear('created_at', $year)->select(
            DB::raw('sum(amount) as sum'),
            DB::raw("DATE_FORMAT(created_at,'%M') as month")
        )->groupBy('month')->get();

        return response()->json([
            'success'=>true,
            'data'=>$data
        ], 200);
    }

    public function testSMS()
    {
        return Vas::send_sms('254715810055', 'Hello');
    }

//    public function ipay(Request $request)
//    {
//        $fields = array(
//            "live"=> "0",
//            "oid"=> "h63673",
//            "inv"=> "112020102292999",
//            "ttl"=> "900",
//            "tel"=> "256715810055",
//            "eml"=> "kajuej@gmailo.com",
//            "vid"=> "demo",
//            "curr"=> "KES",
//            "p1"=> "airtel",
//            "p2"=> "020102292999",
//            "p3"=> "",
//            "p4"=> "900",
//            "cbk"=> env('APP_URL').'api/v1/callback',
//            "cst"=> "1",
//            "crl"=> "2",
//        );
//        $datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];
//        $hashkey ="demoCHANGED";
//        $generated_hash = hash_hmac('sha1',$datastring , $hashkey);
//        array_push($fields, array(
//            'hsh' => $generated_hash
//        ));
//        return Http::post('https://payments.ipayafrica.com/v3/ke', $fields);
//    }
}
