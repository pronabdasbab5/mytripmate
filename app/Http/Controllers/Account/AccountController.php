<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PHotels\PHotels;
use App\Models\PCoupon\PCoupon;
use App\Models\PType\PType;
use App\Models\PImages\PImages;
use App\Models\PBBDetails\PBBDetails;
use App\Models\PBTDetails\PBTDetails;
use App\Models\Package\Package;
use App\Models\User\User;
use App\Models\PPackage\PPackage;
use App\Models\PFacility\PFacility;
use App\Models\PFRelation\PFRelation;
use App\Models\PHotels\PHRelation;
use App\Models\PItenary\PItenary;
use File;
use Illuminate\Support\Facades\Hash;
use Response;
use DB;

class AccountController extends Controller
{
    public function myAccount($user_id) {
    	$pbbdetails     = new PBBDetails;
        $pbtdetails     = new PBTDetails;
        $pbbdetailsData = $pbbdetails->where('package_booking_basic_details.userId', $user_id)
                                    ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                                    ->join('package_hotels', 'package_booking_basic_details.hotelId', '=', 'package_hotels.id')
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.id', 'package_booking_basic_details.userId', 'package_booking_basic_details.packageId', 'package_booking_basic_details.payableAmount', 'package_booking_basic_details.paymentStatus', 'package_booking_basic_details.startDate', 'package.packageTitle', 'package.offer', 'package.duration', 'package_hotels.price as h_price', 'package_coupon.flatAmount')
                                    ->orderBy('package_booking_basic_details.id', 'DESC')
                                    ->first();

         /** Start Search Location **/
        $package             = new Package;
        $packageDurationData = $package
                                    ->select('duration')
                                    ->distinct()
                                    ->get();

        $packageLocationData = $package
                                    ->select('location')
                                    ->distinct()
                                    ->get();
        /** End of Search Location **/

    	return view('account.myaccount', ['pbbdetailsData' => $pbbdetailsData, 'packageDurationData' => $packageDurationData, 'packageLocationData' => $packageLocationData]);
    }

    public function travelBookingDetails ($user_id, $booking_id) {
        $pbbdetails     = new PBBDetails;
        $pbtdetails     = new PBTDetails;
        $pbbdetailsData = $pbbdetails->where('package_booking_basic_details.userId', $user_id)
                                    ->where('package_booking_basic_details.id', $booking_id)
                                    ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                                    ->join('package_hotels', 'package_booking_basic_details.hotelId', '=', 'package_hotels.id')
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.id', 'package_booking_basic_details.userId', 'package_booking_basic_details.totalPersons', 'package_booking_basic_details.payableAmount', 'package_booking_basic_details.packageId', 'package_booking_basic_details.paymentStatus', 'package_booking_basic_details.startDate', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package.totalDays', 'package_hotels.price as h_price', 'package_coupon.flatAmount')
                                    ->orderBy('package_booking_basic_details.id', 'DESC')
                                    ->get();

        /** Start Search Location **/
        $package             = new Package;
        $packageDurationData = $package
                                    ->select('duration')
                                    ->distinct()
                                    ->get();

        $packageLocationData = $package
                                    ->select('location')
                                    ->distinct()
                                    ->get();
        /** End of Search Location **/

        return view('account.travel_booking_details', ['pbbdetailsData' => $pbbdetailsData, 'packageDurationData' => $packageDurationData, 'packageLocationData' => $packageLocationData]);
    }

    public function travelBookings($user_id) {
        $pbbdetails     = new PBBDetails;
        $pbtdetails     = new PBTDetails;
        $pbbdetailsData = $pbbdetails->where('package_booking_basic_details.userId', $user_id)
                                    ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                                    ->join('package_hotels', 'package_booking_basic_details.hotelId', '=', 'package_hotels.id')
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.id', 'package_booking_basic_details.userId', 'package_booking_basic_details.payableAmount', 'package_booking_basic_details.packageId', 'package_booking_basic_details.paymentStatus', 'package_booking_basic_details.startDate', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package.totalDays', 'package_hotels.price as h_price', 'package_coupon.flatAmount')
                                    ->orderBy('package_booking_basic_details.id', 'DESC')
                                    ->get();

        /** Start Search Location **/
        $package             = new Package;
        $packageDurationData = $package
                                    ->select('duration')
                                    ->distinct()
                                    ->get();

        $packageLocationData = $package
                                    ->select('location')
                                    ->distinct()
                                    ->get();
        /** End of Search Location **/

        return view('account.travel_bookings', ['pbbdetailsData' => $pbbdetailsData, 'packageDurationData' => $packageDurationData, 'packageLocationData' => $packageLocationData]);
    }

    public function changePassword ($user_id) {

        /** Start Search Location **/
        $package             = new Package;
        $packageDurationData = $package
                                    ->select('duration')
                                    ->distinct()
                                    ->get();

        $packageLocationData = $package
                                    ->select('location')
                                    ->distinct()
                                    ->get();
        /** End of Search Location **/

        return view('account.change_password', ['packageDurationData' => $packageDurationData, 'packageLocationData' => $packageLocationData]);
    }

    public function setPassword (Request $request, $user_id) {

        $request->validate([
            'password'    => 'bail|required',
            'con_password'=> 'required'
        ],
        [
            'password.required'     => 'The password is required',
            'con_password.required' => 'The confirm password is required',
        ]);

        if($request->input('password') != $request->input('con_password'))
            return redirect()->route('change_password', ['user_id' => $user_id])->with('msg', 'Password and Confirm Password are not same');

        $user = new User;
        $user->where('id', $user_id)
            ->update(['password' => Hash::make($request->input('password'))]);

        return redirect()->route('change_password', ['user_id' => $user_id])->with('msg', 'Password has been changed');       
    }
}
