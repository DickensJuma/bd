<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ContactForm;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $data = $request->all();

        Mail::to('admin@gmail.com')->queue(new ContactForm($data));

        return response([
            'status' => 'success'
        ], 200);
    }
}
