<?php


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


Route::group(['namespace' => 'Api'], function () {

    Route::group(['prefix' => 'auth','namespace' => 'Auth'], function () {
        Route::post('login','LoginController');
        Route::post('register','RegisterController');
        Route::post('check-code','CheckCodeController');
        Route::post('resend-code','ResendCodeController');
        Route::post('forget-password', 'ForgotPasswordController');
        Route::post('reset-password', 'ResetPasswordController');
        Route::post('change-password','ChangePasswordController');
        Route::post('edit-profile','EditProfileController');
        Route::post('log-out','LogOutController');
        Route::post('refresh-token','RefreshTokenController');
    });

    Route::group(['prefix' => 'lists','namespace' => 'List'], function () {

        Route::get('countries','CountryController');
        Route::get('categories','CategoryController');
        Route::get('brands','BrandController');
        Route::get('product-types','ProductTypeController');
        Route::get('shipping','ShippingController');

    });


    Route::group([ 'namespace' => 'Products'], function () {

        Route::get('/products','ProductController');
        Route::get('/products/{product}','ProductController@show');
        Route::get('/filter-products','ProductController@getFilterData');

        Route::apiResource('favorites','FavoriteProductController');

    });

    Route::get('home-page','HomePageController');


    Route::group(['prefix' => 'users','namespace' => 'User'], function () {
        Route::apiResource('address','AddressController');
        Route::get('notifications','NotificationController');
    });

    Route::group(['namespace' => 'Orders'], function () {

        Route::apiResource('my-cart','CartController');
        Route::post('my-cart/create-or-update','CartController@createOrUpdate');

        Route::apiResource('orders','OrderController');

        Route::post('orders/check-coupon','Actions\checkPromoCodeController');
        Route::post('orders/{order}/refuse','Actions\OrderRefuseController');
        Route::post('orders/{order}/accepted','Actions\OrderAcceptedController');
        Route::post('orders/{order}/finish','Actions\OrderFinishController');
        Route::post('orders/{order}/rate','Actions\OrderRateController');

        Route::post('orders/check-promo-code','Actions\checkPromoCodeController');

    });

    Route::group(['prefix' => 'setting'], function () {

        Route::get('/{setting}','SettingsController')
            ->where(['setting' => 'privacy|terms|about_app|developer|website_description']);

        Route::post('contact-us','SettingsController@contactUs');

        Route::get('testNotification','SettingsController@testNotification');
    });




});
