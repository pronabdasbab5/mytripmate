<?php

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

Route::get('/', 'IndexController@index');
Route::get('package_banner_image/{file_name}', 'IndexController@packageBannerImage')->name('package_banner_image');

Auth::routes();

Route::get('/home', 'IndexController@index')->name('home');

Route::namespace('Package')->group(function () {
	Route::get('holiday', 'PackageController@packages')->name('packages');
	Route::get('package_banner/{file_name}', 'PackageController@packageBanner')->name('package_banner');
	Route::get('package_details/{packageId}', 'PackageController@package_details')->name('package_details');
	Route::get('itenary_images/{file_name}', 'PackageController@itenaryImages')->name('itenary_images');
	Route::get('slider_images/{file_name}', 'PackageController@sliderImages')->name('slider_images');

	/** Ajax **/
	Route::post('package_price_change', 'PackageController@package_price_change')->name('package_price_change');
	Route::post('package_coupon_price_calculating', 'PackageController@coupon_price_calculating')->name('package_coupon_price_calculating');
	Route::post('package_search', 'PackageController@package_search')->name('package_search');
	/** End Ajax **/
});

Route::middleware(['auth'])->group(function () {

	Route::namespace('Account')->group(function () {
		Route::get('myaccount/{user_id}', 'AccountController@myAccount')->name('myaccount');
		Route::get('travel_booking_details/{user_id}/{booking_id}', 'AccountController@travelBookingDetails')->name('travel_booking_details');
		Route::get('travel_bookings/{user_id}', 'AccountController@travelBookings')->name('travel_bookings');
		Route::get('change_password/{user_id}', 'AccountController@changePassword')->name('change_password');
		Route::post('password_set/{user_id}', 'AccountController@setPassword')->name('password_set');

		Route::post('pay-pending', 'AccountController@payPending')->name('pay_pending');
		Route::get('pending-pay-success/{booking_id}', 'AccountController@paySuccess');
		Route::get('pending-thankyou', 'AccountController@thankyou')->name('pending_thankyou');
		Route::get('pening-payment-failed', 'AccountController@paymentFailed')->name('pening_payment_failed');
	});

	Route::namespace('Package')->group(function () {
		Route::get('package_booking_form', 'PackageController@package_booking_form')->name('package_booking_form');
		Route::post('package_booking', 'PackageController@package_booking')->name('package_booking');
		Route::get('pay-success/{booking_id}', 'PackageController@paySuccess');
		Route::get('thankyou/{txtNo}', 'PackageController@thankyou')->name('thankyou');
		Route::get('payment-failed', 'PackageController@paymentFailed')->name('payment_failed');
	});
});

Route::namespace('Email')->group(function () {
	Route::post('send_email', 'EmailController@send_email')->name('send_email');
});

require 'admin.php';
