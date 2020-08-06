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

    //auth routes
    Route::post('auth/register', 'API\AuthController@register');
    Route::post('auth/login', 'API\AuthController@login');
    Route::post('auth/createRider', 'API\AuthController@createRiderAccount');
    Route::post('auth/verify_phone', 'API\AuthController@verifyRiderPhone');
    Route::post('auth/loginRider', 'API\AuthController@loginRider');
    Route::post('auth/resetPasswordRider', 'API\AuthController@resetPasswordRider');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('auth/user', 'API\AuthController@user');
        Route::post('auth/logout', 'API\AuthController@logout');
        Route::post('new_coordinates', 'API\LocationTrackingController@CreateLocation');
    });








    Route::get('subcat_brands/{id}', 'API\ProductController@get_subcategory_brands');
    Route::get('/email/resend/{email}', 'API\VerificationController@resend')->name('verification.resend');
    Route::post('auth/emailCheck', 'API\UserController@checkEmail');
    Route::post('password/email', 'API\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'API\ResetPasswordController@reset');
    Route::get('featured-category', 'API\ProductCategoryController@featuredCategory');
    Route::get('featured-products', 'API\ProductController@featuredProducts');
    Route::get('categories', 'API\ShopController@getCategories');
    Route::get('shops', 'API\ShopsController@getShops');
    Route::post('search-categories', 'API\ShopController@searchCategories');
    Route::post('search-shops', 'API\ShopsController@searchShops');
    Route::post('sort-shops', 'API\ShopsController@sortShops');
    Route::post('/email/verify/{id}/{hash}', 'API\VerificationController@verify')->name('verification.verify');
    Route::post('contact', 'API\ContactController@contact');
    Route::post('visited', 'API\ProductController@isVisited');
    Route::prefix('shopLocal')->group(function () {
        Route::get('categories', 'API\ShopController@getCategories');
        Route::get('products/{id}', 'API\ShopController@getCategoryProducts');
        Route::get('sub-categories/{id}', 'API\ShopController@getSubCategories');
        Route::get('categories_sub_brands', 'API\ProductCategoryController@categoriesSubCategoriesBrands');
        Route::get('details/{id}', 'API\ShopController@show');
        Route::post('search-products', 'API\ShopController@searchProducts');
        Route::post('filter-products', 'API\ProductController@filterProducts');

        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::post('apply-coupon', 'API\CouponsController@applyCoupon');
            Route::post('order', 'API\OrdersController@store');
            Route::get('order', 'API\OrdersController@show');
            Route::get('show-details/{id}', 'API\OrdersController@showDetails');
            Route::patch('cancel-order/{id}', 'API\OrdersController@cancelOrder');
            Route::post('pay/{id}', 'API\OrdersController@makePayment');
        });
    });

    Route::group(['prefix' => 'admin'], function () {

        //shopLocal
        Route::group(['middleware' => ['auth.role:admin', 'jwt.auth']], function () {
            //shopLocal
            Route::group(['middleware' => ['auth.role:admin', 'jwt.auth']], function () {
                //User
                Route::apiResources(['user' => 'API\UserController']);
                Route::apiResources(['logs' => 'API\LogsController']);
                Route::post('users/{id}', 'API\UserController@userUpdate');
                Route::get('dashboard', 'API\UserController@dashboard');
                Route::get('customer', 'API\UserController@customers');
                Route::get('rider', 'API\UserController@rider');
                Route::get('wholesaler', 'API\UserController@wholesaler');
                Route::get('retailer', 'API\UserController@retailer');
                Route::get('userDetails/{id}', 'API\UserController@showDetails');
                Route::post('riderDocuments', 'API\UserController@riderDocuments');
                Route::get('riderDocs/{id}', 'API\UserController@riderDocs');
                Route::get('deleteDocs/{id}', 'API\UserController@deleteDocs');
                Route::get('download/{orderId}', 'API\UserController@downloadFile');
                Route::patch('changeStatus/{id}','API\UserController@status');
                Route::patch('changeVerificationStatus/{id}','API\UserController@verificationStatus');
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
                    Route::get('shipment/{id}', 'API\OrdersController@shipment');
                    Route::patch('change-status/{id}', 'API\OrdersController@changeStatus');
                    Route::get('all-products', 'API\ProductController@index');
                    Route::apiResources(['coupon' => 'API\CouponsController']);
                    Route::get('details/{id}', 'API\ShopController@show');
                    Route::patch('update-status/{id}', 'API\ProductController@changeStatus');
                    Route::delete('delete-image/{id}', 'API\ProductController@deleteImage');
                    Route::delete('delete-product/{id}', 'API\ProductController@destroy');
                    Route::patch('activate-product/{id}', 'API\ProductController@activate');
                    Route::post('update-product/{id}', 'API\ProductController@update');
                    Route::post('delivery/{id}','API\DeliveryController@store');
                    Route::get('myRider/{id}','API\DeliveryController@rider');
                    Route::post('Rider/{id}','API\DeliveryController@myRider');
                });
            });
        });
    });
    // wholesaler || retailer
    Route::group(['prefix' => 'retailer'], function () {
        //prefix(dashboard)
        Route::group(['middleware' => ['auth.role:retailer,wholesaler','jwt.auth']], function () {
            Route::group(['prefix' => 'dashboard'], function () {
                Route::post('products', 'API\ProductController@myproducts');
                Route::apiResources(['category' => 'API\ProductCategoryController']);
                Route::apiResources(['Subcategory' => 'API\ProductSubCategoryController']);
                Route::get('sub-category/{id}', 'API\ProductSubCategoryController@getSubcategory');
                Route::get('my-brands/{id}', 'API\BrandsController@getBrands');
                Route::apiResources(['brands' => 'API\BrandsController']);
                Route::get('all-products', 'API\ProductController@suplier');
                Route::delete('delete-product/{id}', 'API\ProductController@destroy');
                Route::delete('delete-image/{id}', 'API\ProductController@deleteImage');
                Route::post('update-product/{id}', 'API\ProductController@update');
                Route::patch('update-status/{id}', 'API\ProductController@changeStatus');
                Route::get('details/{id}', 'API\ShopController@show');
                Route::get('shop-details/{id}', 'API\ShopController@shopDetail');
                Route::post('user/{id}', 'API\UserController@update');
                Route::get('myOrders', 'API\OrdersController@MyOrders');
                Route::get('order-details/{id}', 'API\OrdersController@orderDetail');
                Route::get('showOrderDetails/{id}', 'API\OrdersController@showOrderDetails');
            });
        });
    });
    //Rider
    Route::group(['prefix' => 'rider'], function () {
        //prefix(dashboard)
        Route::group(['middleware' => ['auth.role:rider', 'jwt.auth']], function () {
            Route::group(['prefix' => 'dashboard'], function () {
                Route::get('shipping', 'API\DeliveryController@index');
                Route::get('showShippingInfo/{id}', 'API\DeliveryController@shopInfo');
                Route::get('rider-details/{id}', 'API\RiderController@riderDetail');
                Route::post('user/{id}', 'API\UserController@update');
            });
        });
    });

    //customer
    Route::group(['prefix' => 'customer'], function () {
        //prefix(profile)
        Route::group(['middleware' => ['auth.role:customer', 'jwt.auth']], function () {
            Route::group(['prefix' => 'profile'], function () {
                Route::put('account', 'API\CustomerProfileController@account');
                Route::put('location', 'API\CustomerProfileController@location');
                Route::put('password', 'API\CustomerProfileController@password');
            });
        });
    });
});
