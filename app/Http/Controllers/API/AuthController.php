<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rider;
use App\User;
use App\WholesalerRetailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class AuthController extends Controller
{
    /**
     * @response {
     *  "status": "success",
     * }
     * @bodyParam name string required The name of the user. Example: zenta
     * @bodyParam email string required The email of the user. Example: zenta@gmail.com
     * @bodyParam phone string required The phone number of the user. Must be a kenyan phone number. Example: 0715810055
     * @bodyParam county string required The county of residence of the user. Example: Kisumu
     * @bodyParam town string required The town of residence of the user. Example: Kombewa
     * @bodyParam village string required The village of residence of the user. Example: Kitare
     * @bodyParam password string required The password of the user. A minimum of 8 characters Example: 123456789
     * @bodyParam password_confirmation string required The password of the user. A minimum of 8 characters. ust be equal to the password Example: 123456789
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|phone:KE|min:10',
            'type' => 'required|string',
            'county' => 'required|string',
            'location_name'=>'required|string',
            'password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8',
        ]);

        if($request->type == 'wholesaler' || $request->type == 'retailer'){
            $this->validate($request, [
                'shop_name'=> 'required|string',
            ]);
        }

        if($request->type == 'rider'){
            $this->validate($request, [
                'operation_area'=> 'required|string',
                'id_number'=> 'required|string',
                'vehicle_type'=>'required|string',
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->county = $request->county;
        $user->role = $request->type;
        $user-> longitude = $request->longitude;
        $user-> latitude = $request->latitude;
        $user-> location_name = $request->location_name;
        $user-> address = $request->address;
        $user->password = bcrypt($request->password);
        $user->save();

        if($request->type == 'wholesaler' || $request->type == 'retailer'){
            $wholesaler= new WholesalerRetailer();
            $wholesaler->shop_name = $request->shop_name;
            $wholesaler->user_id = $user->id;
            $wholesaler->save();
        }

        if($request->type == 'rider'){
           $rider = new Rider();
           $rider->id_no = $request->id_number;
           $rider->area_of_operation = $request->operation_area;
           $rider->vehicle_type = $request->vehicle_type;
           $rider-> user_id = $user->id;
           $rider-> save();
        }


        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * @response {
     *  "status": "success",
     * "data":{
     *  "name": "Art Yangu",
     *  "email": "zenta@gmail.com",
     * "type": "artist"
     * }
     * }
     *
     * @bodyParam email string required The email of the user. Example: zenta@gmail.com
     * @bodyParam password string required The password of the user. A minimum of 8 characters Example: 123456789
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $details = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($details)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }

        return response([
            'status' => 'success'
        ])->header('Authorization', $token);
    }

    /**
     * @authenticated
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * @authenticated
     */
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    /**
     * @authenticated
     */
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}
