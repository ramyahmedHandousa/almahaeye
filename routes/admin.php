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
Route::get('/home', 'Admin\HomeController')->name('admin.home')->middleware('adminDashboard');

Route::group(['prefix' => 'administrator' ,'namespace' => 'Admin\Auth'], function () {
    Route::get('/login', 'LoginController')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.postLogin');
});


Route::group(['prefix' => 'administrator' ,'namespace' => 'Admin','middleware' => ['adminDashboard']], function () {


    Route::group(['prefix' => 'manager' ,'namespace' => 'Manager'],function() {

        Route::resource('abilities', 'AbilitiesController');
        Route::post('abilities_mass_destroy', 'AbilitiesController@massDestroy')->name('abilities.mass_destroy');

    });

    Route::post('/logout', 'Auth\LoginController@logout')->name('administrator.logout');

    Route::get('/home', 'HomeController')->name('admin.home')->middleware('auth');

    Route::resource('users', 'UsersController');
    Route::post('users/suspend','UsersController@suspend')->name('users.suspend');

    Route::resource('vendors', 'VendorsController',[
        'parameters' => [  'vendors' => 'user' ]
    ]);
    Route::get('vendors/{user}/marketing','VendorsController@marketing_information')->name('marketing_information');
    Route::post('vendors/update/percentage','VendorsController@percentage')->name('admin_update_percentage');
    Route::post('vendors/update/delivery_price','VendorsController@deliveryPrice')->name('admin_update_delivery_price');

    Route::get('change_profile','ChangeProfileController')->name('change_profile');
    Route::get('change_profile/{id}','ChangeProfileController@acceptedOrRefuse')->name('change_profile_status');

    Route::get('refuse/vendors/{user}','VendorsController@refuse')->name('vendors.refuse');
    Route::get('accepted/vendors/{user}','VendorsController@accepted')->name('vendors.accepted');

    Route::resource('helpAdmin', 'HelpAdminController');

    Route::resource('sliders','SlidersController');
    Route::post('/sliders/delete', 'SlidersController@delete')->name('sliders.delete');

    Route::resource('brands','BrandController');
    Route::post('/brands/delete', 'BrandController@delete')->name('brands.delete');

    Route::resource('banks','BankController');
    Route::post('/banks/delete', 'BankController@delete')->name('banks.delete');

    Route::resource('categories','CategoryController');
    Route::get('sub_categories','CategoryController@sub_categories')->name('sub_categories');
    Route::post('/categories/delete', 'CategoryController@delete')->name('categories.delete');

    Route::resource('countries','CountryController');
    Route::get('sub_countries','CountryController@sub_countries')->name('sub_countries');
    Route::post('/countries/delete', 'CountryController@delete')->name('countries.delete');


    Route::resource('promo_codes','PromoCodeController');
    Route::post('/promo_codes/delete', 'PromoCodeController@delete')->name('promo_codes.delete');

    Route::resource('shipping','ShippingController');
    Route::post('/shipping/delete', 'ShippingController@delete')->name('shipping.delete');

    Route::post('/settings', 'SettingsController@store')->name('administrator.settings.store');
    Route::get('settings/global', 'SettingsController@global')->name('settings.global');
    Route::get('settings/static', 'SettingsController@static')->name('settings.static');
    Route::get('settings/contactus', 'SettingsController@contactus')->name('settings.contactus');

    Route::resource('contact_us_inbox', 'ContactUsController');
    Route::get('updateIsRead', 'ContactUsController@updateIsRead')->name('admin.support.updateIsRead');
    Route::get('updateIsDeleted', 'ContactUsController@updateIsDeleted')->name('admin.support.updateIsDeleted');
    Route::get('removeAllMessages', 'ContactUsController@removeAllMessages')->name('admin.support.removeAllMessages');


    Route::group(['namespace' => 'Products'], function () {

        Route::resource('ages', 'AgeController');
        Route::post('/ages/delete', 'AgeController@delete')->name('ages.delete');

        Route::resource('colors', 'ColorController');
        Route::post('/colors/delete', 'ColorController@delete')->name('colors.delete');

        Route::resource('frame_materials', 'FrameMaterialController');
        Route::post('/frame_materials/delete', 'FrameMaterialController@delete')->name('frame_materials.delete');

        Route::resource('frame_shaps', 'FrameShapController');
        Route::post('/frame_shaps/delete', 'FrameShapController@delete')->name('frame_shaps.delete');

        Route::resource('product_types','ProductTypeController');
        Route::post('/product_types/delete', 'ProductTypeController@delete')->name('product_types.delete');

        Route::resource('products','ProductController');
        Route::post('/products/new', 'ProductController@new')->name('products.new');
        Route::post('/products/delete', 'ProductController@delete')->name('products.delete');
        Route::get('/price/product/brand', 'ProductController@priceBrandVendor')->name('products.priceBrandVendor');

        Route::resource('offers','OfferController');
    });


    Route::get('public_notification','NotificationController')->name('public_notification');
    Route::post('public_notification','NotificationController@send')->name('send_public_notification');


});


