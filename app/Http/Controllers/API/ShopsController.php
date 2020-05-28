<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function getShops(){
        return User::whereIn('role', ['wholesaler', 'retailer'])->whereHas('shop', function ($query){
            $query->where('verification', 'verified');
        })->with(array('shop'=>function($query){
            $query->select('id', 'shop_name', 'profile_image', 'user_id');
        }))->get('id');
    }

    public function searchShops(Request $request){
        $this->validate($request, [
            'search' => 'required|string',
        ]);

        if($search = $request->search) {
            return User::orderBy('name')->whereHas('shop', function ($query) use ($search) {
                $query->where('shop_name', 'LIKE', "%$search%")->where('verification', 'verified');
            })->with(array('shop'=>function($query){
                $query->select('id', 'shop_name', 'profile_image', 'user_id');
            }))->get('id');
        }
    }

    public function sortShops(Request $request){
        $this->validate($request, [
            'sort' => 'required|string|in:wholesaler,retailer',
        ]);

        return User::where('role', $request->sort)->whereHas('shop', function ($query){
            $query->where('verification', 'verified');
        })->with(array('shop'=>function($query){
            $query->select('id', 'shop_name', 'profile_image', 'user_id');
        }))->get('id');
    }
}
