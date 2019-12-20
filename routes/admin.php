<?php

Route::get('/admin/registration', 'RegistrationController@registration')->name('admin.registration');

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

	    Route::get('dashboard', function () {
	        return view('admin.dashboard');
	    })->name('admin.dashboard');

	    //Package Hotels Router
	    Route::get('new_package_hotel', 'Admin\HolidaysController@showPHotelsForm')->name('admin.p_hotel');
	    Route::post('add_package_hotel', 'Admin\HolidaysController@addPHotels')->name('admin.add_p_hotel');
	    Route::get('all_package_hotel', 'Admin\HolidaysController@allPHotels')->name('admin.all_p_hotel');
	    Route::post('package_hotel_data', 'Admin\HolidaysController@allPHotelsData');
	    Route::get('package_hotel_change_status/{pHotelId}/{status}', 'Admin\HolidaysController@pHotelsChangeStatus')->name('admin.p_hotel_change_status');
	    Route::get('package_hotel_edit_form/{pHotelId}', 'Admin\HolidaysController@showPHotelsEditForm')->name('admin.p_hotel_edit_form');
	    Route::post('update_package_hotel/{pHotelId}', 'Admin\HolidaysController@updatePHotels')->name('admin.update_p_hotel');
	    //End of Package Hotels Router

	    //Package Coupon Router
	    Route::get('new_package_coupon', 'Admin\HolidaysController@showPCouponForm')->name('admin.p_coupon');
	    Route::post('add_package_coupon', 'Admin\HolidaysController@addPCoupon')->name('admin.add_p_coupon');
	    Route::get('all_package_coupon', 'Admin\HolidaysController@allPCoupon')->name('admin.all_p_coupon');
	    Route::post('package_coupon_data', 'Admin\HolidaysController@allPCouponData');
	    Route::get('package_coupon_change_status/{pCouponId}/{status}', 'Admin\HolidaysController@pCouponChangeStatus')->name('admin.p_coupon_change_status');
	    Route::get('package_coupon_edit_form/{pCouponId}', 'Admin\HolidaysController@showPCouponEditForm')->name('admin.p_coupon_edit_form');
	    Route::post('update_package_coupon/{pCouponId}', 'Admin\HolidaysController@updatePCoupon')->name('admin.update_package_coupon');
	    //End of Package Coupon Router

	    //Package Type Router
	    Route::get('new_package_type', 'Admin\HolidaysController@showPTypeForm')->name('admin.p_type');
	    Route::post('add_package_type', 'Admin\HolidaysController@addPType')->name('admin.add_p_type');
	    Route::get('all_package_type', 'Admin\HolidaysController@allPType')->name('admin.all_p_type');
	    Route::post('package_type_data', 'Admin\HolidaysController@allPTypeData');
	    Route::get('package_type_edit_form/{pTypeId}', 'Admin\HolidaysController@showPTypeEditForm')->name('admin.p_type_edit_form');
	    Route::post('update_package_type/{pTypeId}', 'Admin\HolidaysController@updatePType')->name('admin.update_package_type');
	    //End of Package Type Router

	    //Package Router
	    Route::get('new_package', 'Admin\HolidaysController@showPForm')->name('admin.p');
	    Route::put('add_package_basic_info', 'Admin\HolidaysController@addPBasicInfo')->name('admin.add_p_basic_info');

	    Route::get('upload_package_images_form/{packageId}', 'Admin\HolidaysController@showUploadPImagesForm')->name('admin.upload_p_images_form');
	    Route::put('upload_package_images/{packageId}', 'Admin\HolidaysController@uploadPImages')->name('admin.upload_p_images');

	    Route::get('upload_package_facility_form/{packageId}', 'Admin\HolidaysController@showUploadPFacilityForm')->name('admin.upload_p_facility_form');
	    Route::post('upload_package_facility/{packageId}', 'Admin\HolidaysController@uploadPFacility')->name('admin.upload_p_facility');
	    Route::get('upload_package_hotel_form/{packageId}', 'Admin\HolidaysController@showUploadPHotelForm')->name('admin.upload_p_hotel_form');
	    Route::post('upload_package_hotel/{packageId}', 'Admin\HolidaysController@uploadPHotel')->name('admin.upload_p_hotel');

	    Route::get('upload_package_itenary_form/{packageId}', 'Admin\HolidaysController@showUploadPItenaryForm')->name('admin.upload_p_itenary_form');
	    Route::put('upload_package_itenary/{packageId}', 'Admin\HolidaysController@uploadPItenary')->name('admin.upload_p_itenary');

	   Route::get('all_package', 'Admin\HolidaysController@allPackage')->name('admin.all_package');
	   Route::post('all_package_data', 'Admin\HolidaysController@allPackageData')->name('admin.all_package_data');
	   Route::get('package_edit_form/{packageId}', 'Admin\HolidaysController@showPackageEditForm')->name('admin.p_edit_form');
	   Route::post('update_package/{packageId}', 'Admin\HolidaysController@updatePackage')->name('admin.update_package');
	   Route::get('package_status_change/{packageId}', 'Admin\HolidaysController@changePackageStatus')->name('admin.package_status_change');
	   Route::get('package_banner_image_change/{packageId}', 'Admin\HolidaysController@changePackageBannerImage')->name('admin.package_banner_image_change');
	   Route::put('update_banner_image/{filename}/{packageId}', 'Admin\HolidaysController@updateBannerImage')->name('admin.update_banner_image');
	   Route::get('banner_image/{filename}', 'Admin\HolidaysController@bannerImage')->name('admin.banner_image');
	   Route::get('package_other_section/{packageId}', 'Admin\HolidaysController@packageOtherSection')->name('admin.package_other_section');
	   Route::get('package_slider_image_change/{packageId}', 'Admin\HolidaysController@changePackageSliderImage')->name('admin.package_slider_image_change');
	   Route::get('slider_image/{filename}', 'Admin\HolidaysController@sliderImage')->name('admin.slider_image');
	   Route::put('update_slider_image/{filename}/{packageId}', 'Admin\HolidaysController@updateSliderImage')->name('admin.update_slider_image');
	   Route::get('edit_package_facility_form/{packageId}', 'Admin\HolidaysController@editPackageFacilityForm')->name('admin.edit_package_facility_form');
	   Route::post('update_package_facility/{packageId}', 'Admin\HolidaysController@updatePackageFacility')->name('admin.update_package_facility');
	   Route::get('edit_package_hotel_form/{packageId}', 'Admin\HolidaysController@editPackageHotelForm')->name('admin.edit_package_hotel_form');
	   Route::post('update_package_hotels/{packageId}', 'Admin\HolidaysController@updatePackageHotels')->name('admin.update_package_hotels');
	   Route::get('edit_package_itenary_form/{packageId}', 'Admin\HolidaysController@editPackageItenaryForm')->name('admin.edit_package_itenary_form');
	   Route::put('update_package_itenarys/{packageId}', 'Admin\HolidaysController@updatePackageItenarys')->name('admin.update_package_itenarys');
	   Route::get('itenary_image/{filename}', 'Admin\HolidaysController@itenaryImage')->name('admin.itenary_image');
	   Route::get('make_popular_package/{packageId}', 'Admin\HolidaysController@makePopularPackage')->name('admin.make_popular_package');
	   Route::get('edit_package_price_form/{packageId}', 'Admin\HolidaysController@editPackagePriceForm')->name('admin.edit_package_price_form');
	   Route::post('update_package_price/{packageId}', 'Admin\HolidaysController@updatePackagePrice')->name('admin.update_package_price');
	   Route::get('delete_price/{price_id}/{packageId}', 'Admin\HolidaysController@deletePackagePrice')->name('admin.delete_price');

	   	/** Ajax Call **/
	   	Route::get('/package_details/{package_id}', function(App\Models\Package\Package $package, $package_id) {

	        $package_data = $package
                            ->join('package_type', 'package.packageType', '=', 'package_type.id')
                            ->select('package.id', 'package.packageId', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package_type.packageType', 'package.isApplicable', 'package.status', 'package.packageDesc', 'package.totalDays', 'package.totalNights', 'package.location', 'package.longitude', 'package.latitude', 'package.rating', 'package.isApplicable')
                            ->where('package.id', $package_id)
                            ->get();

	        if($package_data[0]['status'] == "1")
	            $status = "Active";
	        else
	            $status = "De-Active";

	        if($package_data[0]['isApplicable'] == "1")
	            $isApplicable = "Yes";
	        else
	            $isApplicable = "No";

	        $value = "<p>Package ID : <b id=\"package_id_modal\">".$package_data[0]['packageId']."</b></p><p>Package Type : <b id=\"package_type_modal\">".$package_data[0]['packageType']."</b></p><p>Package Title : <b id=\"package_title_modal\">".$package_data[0]['packageTitle']."</b><p>Description : <b id=\"package_desc_modal\">".$package_data[0]['packageDesc']."</b></p><p>Offer : <b>".$package_data[0]['offer']."</b></p><p>Duration : <b id=\"package_duration_modal\">".$package_data[0]['duration']."</b> and Total Days : <b>".$package_data[0]['totalDays']."</b> and Total Nights : <b>".$package_data[0]['totalNights']."</b></p><p>Location : <b id=\"package_location_modal\">".$package_data[0]['location']."</b> and Longitude : <b>".$package_data[0]['longitude']."</b> and Latitude : <b>".$package_data[0]['latitude']."</b></p><p>Rating : <b>".$package_data[0]['rating']."</b></p><p>Offer Applicable : <b>".$isApplicable."</b> and Status : <b>".$status."</b></p>";

	        print $value;
	    });
	   /** End of Ajax Call **/

	    //End of Package Router

	   /** Pacakge Booking Router **/
	   Route::get('package_booking/{status}', 'Admin\HolidaysController@packageBooking')->name('admin.p_booking');
	   Route::post('package_booking_data', 'Admin\HolidaysController@packageBookingData');
	   Route::get('package_booking_status/{bookingId}/{status}', 'Admin\HolidaysController@pacakgeBookingStatus')->name('admin.p_booking_status');
	   Route::get('package_booking_invoice/{bookingId}', 'Admin\HolidaysController@pacakgeBookingInvoice')->name('admin.p_booking_invoice');
	   Route::get('all_package_booking', 'Admin\HolidaysController@allPackageBooking')->name('admin.all_p_booking');
	   Route::post('all_package_booking_data', 'Admin\HolidaysController@allPackageBookingData');
	   Route::get('package_booking_payment/{bookingId}/{status}', 'Admin\HolidaysController@packageBookingPayment')->name('admin.p_booking_payment');
	   /** End of Package Booking Router **/

	});
});
?>