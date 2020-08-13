<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function getRiders()
    {
        return User::where('role', 'rider')->orderBy('name')->with(array("ride" => function ($q) {
            $q->where('verification', 'verified');
        }))->get(['id', 'name', 'phone']);
    }
}
