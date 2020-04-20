<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'county' => 'required|string|max:191',
            'town' => 'required|string|max:191',
            'role' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'village' => 'required|string|max:191',

        ]);
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => $request['role'],
            'county' => $request['county'],
            'town' => $request['town'],
            'village' => $request['village'],
            'password' => Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        return response($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'password' => 'sometimes|required|min:6',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'town' => 'required|string|max:191',
            'role' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'village' => 'required|string|max:191',
        ]);
        $user->update($request->all());
        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['message'=> 'user deleted'];
    }

    public function checkEmail(Request $request){

        $validatedData = $request->validate([
            "email" => "email || required"
        ]);

        $user = User::where('email','=',$validatedData['email'])->firstorfail();

        return response(['status'=>'Found'], 200);
    }

}
