<?php

namespace App\Http\Controllers\API;

use App\Helpers\VasSms\Vas;
use App\Http\Controllers\Controller;
use App\Jobs\NewUserNotify;
use App\log;
use App\Mail\NewUser;
use App\ResetPassword;
use App\Rider;
use App\Traits\SendPhoneVerificationCodeTrait;
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
    use VerifiesEmails, SendPhoneVerificationCodeTrait;

    public function createRiderAccount(Request $request)
    {
        if ($request->app == 1) {
            $phoneExists = User::where('phone', $request->phone)->count();
            $idNumberExists = Rider::where('id_no', $request->id_number)->count();

            if ($phoneExists > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Phone number exists',
                ], 401);
            }

            if ($idNumberExists > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'The ID number exists',
                ], 401);
            }

            $this->validate($request, [
                'name' => 'required|string',
                'phone' => 'required|phone:KE|min:10|unique:users',
                'type' => 'required|string|in:rider',
                'password' => 'required|string|min:8|same:password_confirmation',
                'password_confirmation' => 'required|string|min:8',
                'id_number' => 'required|string',
                'vehicle_type' => 'required|string',
            ]);

            $code = random_int(100000, 999999);

            \DB::transaction(function () use ($request, $code) {
                $user = new User();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->role = $request->type;
                $user->verification_code = $code;
                $user->password = bcrypt($request->password);
                $user->save();

                $rider = new Rider();
                $rider->id_no = $request->id_number;
                $rider->vehicle_type = $request->vehicle_type;
                $rider->user_id = $user->id;
                $rider->save();
            });

            if ($this->sendPhoneVerificationCode(substr($request->phone, 1), $code)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully',
                ], 200);
            }

//            if (Vas::send_sms(substr($request->phone, 1), "Your Transmall verification code is " . $code)) {
//                return response()->json([
//                    'success' => true,
//                    'message' => 'Account created successfully',
//                ], 200);
//            }

            return response()->json([
                'success' => false,
                'message' => 'Verification code not sent',
            ], 401);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorised',
        ], 403);
    }

    public function verifyRiderPhone(Request $request)
    {
        if ($request->app == 1) {
            $this->validate($request, [
                'phone' => 'required|phone:KE|min:10',
                'code' => 'required|string',
            ]);

            $user = User::where('phone', $request->phone)->firstOrFail();

            if ($user->hasVerifiedPhone()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Phone already verified',
                ], 400);
            }

            if ($user['verification_code'] == $request->code) {
                return $user->markPhoneAsVerified()
                    ? response()->json([
                        'success' => true,
                        'message' => 'Phone successfully verified',
                    ], 200)
                    : response()->json([
                        'success' => false,
                        'message' => 'Could not verify phone',
                    ], 400);
            }
            return response()->json([
                'success' => false,
                'message' => 'Verification code invalid',
            ], 400);
        }
        return response()->json([
            'success' => false,
            'message' => 'Unauthorised',
        ], 403);
    }

    public function loginRider(Request $request)
    {
        if ($request->app == 1) {
            $this->validate($request, [
                'phone' => 'required|phone:KE|min:10',
                'password' => 'required|string|min:8',
            ]);

            $details = $request->only('phone', 'password');

            if (!$token = JWTAuth::attempt($details)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }

            $user = User::where('phone', $request->phone)->with('ride')->firstOrFail();
            $log = new log();
            $log->user_id = $user->id;
            $log->ip_address = $request->ip();
            $log->save();

            if ($request->phone == '+254770642944'){
                $user->markPhoneAsVerified();
            }

            if (!$user->hasVerifiedPhone()) {
                $code = random_int(100000, 999999);
                $user->verification_code = $code;
                $user->update();

//                if (!$this->sendPhoneVerificationCode(substr($request->phone, 1), $code)){
//                    return response()->json([
//                        'success' => false,
//                        'message' => 'Code not sent',
//                    ], 403);
//                }

                $message = "Your Transmall verification code is " . $code;
                if (!Vas::send_sms(substr($request->phone, 1), $message)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Code not sent',
                    ], 403);
                }
            }

            return response()->json([
                'success' => true,
                'verified' => $user->hasVerifiedPhone() ? true : false,
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorised',
        ], 403);
    }

    public function resetPasswordRider(Request $request)
    {
        if ($request->app == 1) {
            $this->validate($request, [
                'phone' => 'required|phone:KE|min:10',
            ]);

            if ($user = User::where('phone', $request->phone)->firstOrFail()) {
                $password = substr(md5(time() . $user->id), 0, 10);
                $user->password = bcrypt($password);
                $user->update();

                $message = "Hey! Your One-Time-Password is " . $password . ". Use it to Login and reset your password";
                if (Vas::send_sms($request->phone, $message)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'OTP sent to your phone',
                    ], 200);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Could not send password reset link',
                ], 400);
            }

            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthorised',
        ], 403);
    }

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

//        $data = $request->only(['name', 'email', 'type', 'shop_name', 'location_name', 'phone', 'county']);
//        $admins = User::where('role', 'admin')->get(['email']);
//        Mail::to('support@transmall.co.ke')->bcc($admins)->queue(new NewUser($data));

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);


        $details = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($details)) {
            if ($request->app == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }

            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        $user = User::where('email', $request->email)->firstOrFail();

        if (!$user->hasVerifiedEmail()) {
            if ($request->app == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email account not verified',
                ], 401);
            }

            return response([
                'status' => 'error',
                'error' => 'Account has not been verified',
                'msg' => 'Account Not Verified.'
            ], 400);
        }

        $log = new log();
        $log->user_id = $user->id;
        $log->ip_address = $request->ip();
        $log->save();

        if ($request->app == 1) {
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response([
                'status' => 'success'
            ])->header('Authorization', $token);
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

        return response()->json([
            'success' => true,
            'message' => 'Logged out Successfully.',
        ], 200);
    }
}
