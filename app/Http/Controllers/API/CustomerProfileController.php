<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
/**
 * @group  Customer Profile
 *
 * APIs for Managing customer Profile
 */
class CustomerProfileController extends Controller
{
    public function account(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|phone:KE|min:10',
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->update();

        return response([
            'status' => 'success'
        ], 200);
    }

    public function location(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|string'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->county = $request->county;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;
        $user->location_name = $request->location_name;
        $user->address = $request->address;
        $user->update();

        return response([
            'status' => 'success'
        ], 200);
    }

    public function password(Request $request){
        $this->validate($request, [
            'new_password' => 'required|string|min:8|same:new_password_confirmation',
            'new_password_confirmation' => 'required|string|min:8',
            'old_password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail(auth()->user()->id);

        if (!Hash::check($request->old_password, $user->password)){
            throw ValidationException::withMessages(['old_password' => 'Does not match the old password']);
        }

        if (Hash::check($request->new_password, $user->password)){
            throw ValidationException::withMessages(['new_password' => 'New password should not be same as old password']);
        }

        $user->password = bcrypt($request->new_password);
        $user->update();

        return response([
            'status' => 'success'
        ], 200);
    }
}
