<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::group(['middleware' => 'jwt.refresh'], function () {
        Route::get('auth/refresh', 'API\AuthController@refresh');
    });

    Route::post('auth/register', 'API\AuthController@register');
    Route::post('auth/login', 'API\AuthController@login');
    Route::get('/email/verify/{id}/{hash}', 'API\VerificationController@verify')->name('verification.verify');


    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('auth/user', 'API\AuthController@user');
        Route::post('auth/logout', 'API\AuthController@logout');
        Route::get('/email/resend', 'API\VerificationController@resend')->name('verification.resend');
    });
});
