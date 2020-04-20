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

    Route::group(['prefix' => 'admin'], function () {
        //User
        Route::apiResources(['user' => 'API\UserController']);

        //shopLocal
        Route::group(['middleware' => 'auth.role:admin,stock-manager'], function () {
            Route::prefix('shopLocal')->group(function () {
                Route::apiResources(['category' => 'API\ProductCategoryController']);
                Route::apiResources(['Subcategory' => 'API\ProductSubCategoryController']);
                Route::get('sub-category/{id}', 'API\ProductSubCategoryController@getSubcategory');
                Route::apiResources(['brands' => 'API\BrandsController']);
                Route::get('my-brands/{id}', 'API\BrandsController@getBrands');
                Route::apiResources(['products' => 'API\ProductController']);
                Route::get('brand-products/{id}', 'API\ProductController@getProducts');
                Route::get('order', 'API\OrdersController@showAll');
                Route::get('show-details/{id}', 'API\OrdersController@showDetails');
                Route::patch('change-status/{id}', 'API\OrdersController@changeStatus');
                Route::get('all-products', 'API\ProductController@index');
                Route::apiResources(['coupon' => 'API\CouponsController']);
                Route::get('details/{id}', 'API\ShopController@show');
                Route::patch('update-status/{id}', 'API\ProductController@changeStatus');
                Route::delete('delete-image/{id}', 'API\ProductController@deleteImage');
                Route::delete('delete-product/{id}', 'API\ProductController@destroy');
                Route::post('update-product/{id}', 'API\ProductController@update');
                });
            });
        });
    });
