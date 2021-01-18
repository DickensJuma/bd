<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

/**
 * @group  Shops
 *
 * APIs for Managing Shops
 */
class ShopsController extends Controller
{

    /**
     * Get wholesaler and retailer shops
     *
     * [Here we get verified shop with the ID, shop Name, profile image and User_id : you can then use these details to get Wholesaler products.]
     *
     */
    public function getShops(){
        return User::where('role', 'retailer')->whereHas('shop', function ($query){
            $query->where('verification', 'verified');
        })->with(array('shop'=>function($query){
            $query->select('id', 'shop_name', 'profile_image', 'user_id');
        }))->get('id');
    }

    public function getWholesalers(){
        return User::where('role', 'wholesaler')->whereHas('shop', function ($query){
            $query->where('verification', 'verified');
        })->with(array('shop'=>function($query){
            $query->select('id', 'shop_name', 'profile_image', 'user_id');
        }))->get('id');
    }
    /**
     * Search for a given shop
     *@bodyParam search String required details of the shop . Example: Nakumart
     *
     *
     */
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
