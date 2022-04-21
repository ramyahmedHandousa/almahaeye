<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Controllers\Website'], function () {

    Route::get('/', 'indexController')->name('home-page');

    Route::get('categories/{category?}','CategoryController')->name('categories');

    Route::get('products/{product?}','ProductController')->name('products');
    Route::get('virtual-product/{product}','ProductController@virtual')->name('virtual-product');
    Route::group(['namespace' => 'Auth'], function () {

        Route::post('/login','LoginController')->name('login');
        Route::get('/log-out','LoginController@logOut')->name('log-out');
        Route::get('/sign-user','RegisterController')->name('sign-user');
        Route::get('/sign-up-vendor','RegisterController@signUpVendor')->name('sign-up-vendor');
        Route::get('/countries/data','RegisterController@countriesData')->name('countries-data');
        Route::post('/register-user','RegisterController@register')->name('register-user');
        Route::post('/register-vendor','RegisterController@registerVendor')->name('register-vendor');
        Route::get('/complete/marking_agree','MarkingAgreeController')->name('complete-marking-agree');
        Route::post('/submit/complete/marking_agree','MarkingAgreeController@store')->name('submit-marking-agree');

        Route::get('/check/code','ActiveController')->name('check-user-code');
        Route::post('/active/account','ActiveController@active')->name('auth.activation.account');
        Route::get('/resend/code','ActiveController@resendCode')->name('auth.resend.code');

        Route::get('forget/password','ForgetPasswordController')->name('auth-forget-password');
        Route::post('forget/password','ForgetPasswordController@forgetPassword')->name('auth-send-forget-password');

        Route::get('new/password','ResetPasswordController')->name('auth-new-password');
        Route::post('new/password','ResetPasswordController@updatePassword')->name('auth-send-new-password');

        Route::get('my-profile','ProfileController')->name('my-profile');
        Route::post('edit-profile','ProfileController@editProfile')->name('auth.update.profile');
        Route::post('edit-password','ProfileController@editPassword')->name('auth.update.password');
        Route::post('edit-image','ProfileController@editImage')->name('auth.update.image');
    });

    Route::resource('addresses','AddressController');
    Route::post('addresses/delete','AddressController@destroy')->name('addresses.delete');

    Route::resource('my-favorite-products','FavoriteProductController',[
        'parameters' => [  'favorite-products' => 'product' ]
    ]);

    Route::group(['namespace' => 'Vendor'], function () {

        Route::resource('vendor-products','ProductController',[
            'parameters' => [  'vendor-products' => 'product' ]
        ]);
        Route::post('vendor-products-delete','ProductController@destroy')->name('vendor-products.delete');
        Route::post('vendor-products-rate','RateProductController@store')->name('vendor-products.rate');
        Route::get('/list/categories/data','ProductController@categoriesData')->name('categories-data');

    });

    Route::group(['namespace' => 'Order'], function () {

        Route::resource('cart','CartController',[
            'parameters' => [  'cart' => 'product' ]
        ]);

        Route::get('/check-code','CartController@checkCode');

        Route::resource('orders','OrderController');
        Route::post('refuse-order/{order}','actions\refuseOrderController')->name('refuse-order');
        Route::post('accepted-order/{order}','actions\acceptedOrderController')->name('accepted-order');
        Route::post('finish-order/{order}','actions\finishOrderController')->name('finish-order');
    });

    Route::group(['namespace' => 'Setting'], function () {

        Route::get('/global/{setting}','SettingController')
            ->where(['setting' => 'privacy|terms|about_app|developer|website_description'])
            ->name('global-setting');

        Route::get('contact-us','ContactUsController')->name('contact-us');
        Route::post('contact/us','ContactUsController@store')->name('send.contact.us');

    });


//    Route::get('payment', 'MyFatoorahController@index');
    Route::get('payment', 'MyFatoorahController@index')->name('pay-online');
    Route::get('my-payment/callback', 'MyFatoorahController@callback');
    Route::get('my-payment/error', 'MyFatoorahController@error');

});


Route::get('/search','Livewire\Products')->name('search');



Route::get('test-phone',function (){

     \App\Http\Helpers\Sms::test('+966591496036','code active ');

});

Route::view('test_vr','test_vr');

Route::get('bola',function (\Illuminate\Http\Request $request){

    $ids = [1,2,3,4,5,6];


    return  redirect()->route('pay-online',['ids' => json_encode($ids),'total' => 1000]);
//    return  redirect()->route('pay-online');
});
