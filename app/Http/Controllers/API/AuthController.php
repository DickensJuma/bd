<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\NewUserNotify;
use App\Mail\NewUser;
use App\Rider;
use App\User;
use App\WholesalerRetailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;

use Illuminate\Support\Facades\Mail;
use JWTAuth;


class AuthController extends Controller
{
    use VerifiesEmails;
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|phone:KE|min:10',
            'type' => 'required|string|in:customer,wholesaler,retailer,rider',
            'county' => 'required|string',
            'location_name' => 'required|string',
            'password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8',
        ]);

        if ($request->type == 'wholesaler' || $request->type == 'retailer') {
            $this->validate($request, [
                'shop_name' => 'required|string',
            ]);
        }

        if ($request->type == 'rider') {
            $this->validate($request, [
                'operation_area' => 'required|string',
                'id_number' => 'required|string',
                'vehicle_type' => 'required|string',
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->county = $request->county;
        $user->role = $request->type;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;
        $user->location_name = $request->location_name;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->sendEmailVerificationNotification();

        if ($request->type == 'wholesaler' || $request->type == 'retailer') {
            $wholesaler = new WholesalerRetailer();
            $wholesaler->shop_name = $request->shop_name;
            $wholesaler->user_id = $user->id;
            $wholesaler->save();
        }

        if ($request->type == 'rider') {
            $rider = new Rider();
            $rider->id_no = $request->id_number;
            $rider->area_of_operation = $request->operation_area;
            $rider->vehicle_type = $request->vehicle_type;
            $rider->user_id = $user->id;
            $rider->save();
        }

        $data = $request->only(['name', 'email', 'type', 'shop_name', 'location_name', 'phone', 'county']);
        $admins = User::where('role', 'admin')->get(['email']);
        Mail::to('support@transmall.co.ke')->bcc($admins)->queue(new NewUser($data));

        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    protected function sendAdminEmail($data)
    {
       $this->dispatch(new NewUserNotify($data));
    }

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
        $user = User::where('email',$request->email)->firstOrFail();
        if($user->email_verified_at !== NULL){
            return response([
                'status' => 'success'
            ])->header('Authorization', $token);
        }else{
            return response([
                'status' => 'error',
                'error' => 'Account has not been verified',
                'msg' => 'Account Not Verified.'
            ], 400);
        }
        
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
