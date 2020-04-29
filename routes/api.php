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
    Route::get('featured-category', 'API\ProductCategoryController@featuredCategory');
    Route::get('categories', 'API\ShopController@getCategories');
    Route::get('shops', 'API\ShopsController@getShops');
    Route::post('search-categories', 'API\ShopController@searchCategories');
    Route::post('search-shops', 'API\ShopsController@searchShops');
    Route::post('sort-shops', 'API\ShopsController@sortShops');
//    Route::get('/email/verify/{id}/{hash}', 'API\VerificationController@verify')->name('verification.verify');
    Route::prefix('shopLocal')->group(function () {
        Route::get('categories', 'API\ShopController@getCategories');
        Route::get('products/{id}', 'API\ShopController@getCategoryProducts');
        Route::get('sub-categories/{id}', 'API\ShopController@getSubCategories');
        Route::get('details/{id}', 'API\ShopController@show');
        Route::post('apply-coupon', 'API\CouponsController@applyCoupon');
        Route::post('search-products', 'API\ShopController@searchProducts');
    });



    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('auth/user', 'API\AuthController@user');
        Route::post('auth/logout', 'API\AuthController@logout');
//        Route::get('/email/resend', 'API\VerificationController@resend')->name('verification.resend');
    });

    Route::group(['prefix' => 'admin'], function () {

        //shopLocal
        Route::group(['middleware' => ['auth.role:admin', 'jwt.auth']], function () {
            //shopLocal
            Route::group(['middleware' => ['auth.role:admin', 'jwt.auth']], function () {
                //User
                Route::apiResources(['user' => 'API\UserController']);
                Route::post('users/{id}', 'API\UserController@userUpdate');
                Route::get('dashboard', 'API\UserController@dashboard');
                Route::get('customer', 'API\UserController@customers');
                Route::get('rider', 'API\UserController@rider');
                Route::get('wholesaler', 'API\UserController@wholesaler');
                Route::get('retailer', 'API\UserController@retailer');
                Route::prefix('shopLocal')->group(function () {
                    Route::apiResources(['category' => 'API\ProductCategoryController']);
                    Route::apiResources(['Subcategory' => 'API\ProductSubCategoryController']);
                    Route::get('sub-category/{id}', 'API\ProductSubCategoryController@getSubcategory');
                    Route::apiResources(['brands' => 'API\BrandsController']);
                    Route::get('my-brands/{id}', 'API\BrandsController@getBrands');
                    Route::apiResources(['products' => 'API\ProductController']);
                    Route::get('shop', 'API\ProductController@shop');
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
    Route::group(['prefix' => 'customer'], function () {
        //shopLocal
        Route::group(['middleware' => ['auth.role:customer', 'jwt.auth']], function () {
            Route::group(['prefix' => 'profile'], function () {
                Route::put('account', 'API\CustomerProfileController@account');
                Route::put('location', 'API\CustomerProfileController@location');
                Route::put('password', 'API\CustomerProfileController@password');
            });
        });
    });
});
