<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\AccountUnverified;
use App\Mail\AccountVerified;
use App\RiderDocs;
use App\WholesalerRetailer;
use App\Rider;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('role', 'admin')->latest()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $total_customer = User::where('role', 'customer')->count();
        $total_wholesaler = User::where('role', 'wholesaler')->count();
        $total_retailer = User::where('role', 'retailer')->count();
        $total_riders = User::where('role', 'rider')->count();
        $total_admins = User::where('role', 'admin')->count();
        $data = array(
            'total_customer' => $total_customer,
            'total_wholesaler' => $total_wholesaler,
            'total_retailer' => $total_retailer,
            'total_riders' => $total_riders,
            'total_admins' => $total_admins
        );
        return ['data' => $data];

    }

    public function customers()
    {
        return User::where('role', 'customer')->latest()->get();
    }

    public function rider()
    {
        return User::where('role', 'rider')->latest()->get();
    }

    public function wholesaler()
    {
        return User::where('role', 'wholesaler')->latest()->get();
    }

    public function retailer()
    {
        return User::where('role', 'retailer')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->county = $request->county;
        $user->location_name = $request->town;
        $user->password = Hash::make($request->password);
        $user->save();


        if ($request->role == 'wholesaler' || $request->role == 'retailer') {
            $this->validate($request, [
                'shop' => 'required|string|max:191 ',
            ]);

            $shop = new WholesalerRetailer();
            $shop->shop_name = $request->shop;
            $shop->user_id = $user->id;
            $shop->save();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
        return response($user, 200);
    }

    public function showDetails($id)
    {
        return User::where('id', $id)->with('shop')->with('ride')->with('product')->firstOrFail();
    }
    public function getMyDoc($id){
        return RiderDocs::where('rider_id', $id)->get();
    }

    public function riderDocuments(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|integer'
        ]);
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                $ext = $uploadedFile->getClientOriginalExtension();
                if (in_array($ext, ['jpg', 'png', 'jpeg'])) {
                    $name = $uploadedFile->getClientOriginalName();
                    $filename = time() . $uploadedFile->getClientOriginalName();
                    \Image::make($uploadedFile)->resize(600, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/storage/uploads/') . $filename);
                    $file = new RiderDocs();
                    $file->rider_id = $request->id;
                    $file->name = $name;
                    $file->filename = $filename;
                    $file->type = 'image';
                    $file->save();
                }else if(in_array($ext, ['pdf', 'doc', 'docx','ods'])){
                    $name = $uploadedFile->getClientOriginalName();
                    $filename = $uploadedFile->storeAs('public/uploads', time() . $uploadedFile->getClientOriginalName());
                    $file = new RiderDocs();
                    $file->rider_id = $request->id;
                    $file->name = $name;
                    $file->filename = $filename;
                    $file->type = 'docx';
                    $file->save();
                }

            }
        }
        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function riderDocs($id){
        return RiderDocs::where('rider_id',$id)->get();
    }
    public function deleteDocs($id){
        $doc = RiderDocs::findOrFail($id);
        $doc->delete();
        return ['message' => 'doc deleted'];
    }

    public function status(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->update();

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function verificationStatus(Request $request, $id)
    {
        $this->validate($request, [
            'verification' => 'required|string|in:verified,unverified',
        ]);

        $user = User::findOrFail($id);

        if ($user->role == 'wholesaler' || $user->role == 'retailer'){
            $shop = WholesalerRetailer::where('user_id', $id)->firstOrFail();
            $shop->verification = $request->verification;
            $shop->update();

            if ($request->verification == 'verified'){
                Mail::to($user->email)->queue(new AccountVerified($user));
            }

            if ($request->verification == 'unverified'){
                Mail::to($user->email)->queue(new AccountUnverified($user));
            }
        }

        if ($user->role == 'rider'){
            $rider = Rider::where('user_id', $id)->firstOrFail();
            $rider->verification = $request->verification;
            $rider->update();
        }

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'town' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'county' => 'required|string|max:191',
            'role' => 'required|string|max:191',
        ]);

        if ($request->password) {
            $this->validate($request, [
                'password' => 'required|string|min:8',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->county = $request->county;
        $user->phone = $request->phone;
        $user->location_name = $request->town;
        $user->role = $request->role;
        $user->update();
        return response(['status' => 'success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'password' => 'sometimes|required|min:6',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'location_name' => 'required|string|max:191',
            'role' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
        ]);
        if ($request->password) {
            $this->validate($request, [
                'password' => 'required|string|min:6'
            ]);
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->county = $request->county;
        $user->role = $request->role;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;
        $user->location_name = $request->location_name;
        $user->address = $request->address;
        $user->update();

        if ($request->role == 'wholesaler' || $request->role == 'retailer') {
            $this->validate($request, [
                'shop_name' => 'required',
            ]);

            $shop = WholesalerRetailer::where('user_id', $user->id)->firstOrFail();
            $shop->shop_name = $request->shop_name;

            if ($request->Imagefile) {

                $file = $request->Imagefile;
                $ext = explode('/', explode(':', substr($file, 0,
                    strpos($file, ';')))[1])[1];

                if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                    $image = time() . '.' . explode('/', explode(':', substr($file, 0,
                            strpos($file, ';')))[1])[1];
                    \Image::make($file)->resize(500, 500)->save(public_path('/storage/uploads/') . $image);
                    $shop->profile_image = $image;
                }
            }
            $shop->update();
        }

        if ($request->role == 'rider') {
            $this->validate($request, [
                'id_number' => 'required',
                'vehicle_type' => 'required',
                'operation_area' => 'required'
            ]);
            $rider = Rider::updateOrCreate(
                ['user_id' => $id],
                ['id_no' => $request->id_number,
                    'vehicle_type' => $request->vehicle_type,
                    'area_of_operation' => $request->operation_area]
            );
        }
        return response(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'user deleted'];
    }
    public function downloadFile($id)
    {
        $file = RiderDocs::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/' . $file->filename);

        return response()->download($pathToFile);
    }
    public function checkEmail(Request $request)
    {

        $validatedData = $request->validate([
            "email" => "email || required"
        ]);

        $user = User::where('email', '=', $validatedData['email'])->firstorfail();

        return response(['status' => 'Found'], 200);
    }

}
