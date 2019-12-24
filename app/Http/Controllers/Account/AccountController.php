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
use Auth;

class AccountController extends Controller
{
    public function myAccount($user_id) {
    	$pbbdetails     = new PBBDetails;
        $pbtdetails     = new PBTDetails;
        $pbbdetailsData = $pbbdetails->where('package_booking_basic_details.userId', $user_id)
                                    ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.*', 'package.packageTitle', 'package.offer', 'package.duration', 'package_coupon.flatAmount')
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
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.*', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package.totalDays', 'package_coupon.flatAmount')
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
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.*', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package.totalDays', 'package_coupon.flatAmount')
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

    public function payPending (Request $request) {

        $request->validate([
            'amount' => 'required',
            'booking_id' => 'required',
        ]);

        try {
            $booking_id = decrypt($request->booking_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $user_detail = DB::table('users')
                ->where('id', Auth::id())
                ->first();

        $booking_detail = DB::table('package_booking_basic_details')
                ->where('id', $booking_id)
                ->first();

            /** Payment Section **/
             $api = new \Instamojo\Instamojo(
                    config('services.instamojo.api_key'),
                    config('services.instamojo.auth_token'),
                    config('services.instamojo.url')
                ); 
            try {
               $response = $api->paymentRequestCreate(array(
                   "purpose" => "Payment",
                   "amount" => $request->input('amount'),
                   "buyer_name" => $user_detail->name,
                   "send_email" => true,
                   "email" => $user_detail->email,
                   "phone" => $user_detail->mobile_no,
                   "redirect_url" => "http://127.0.0.1:8000/pending-pay-success/".$booking_id,
                ));

                   DB::table('package_booking_basic_details')
                        ->where('id', $booking_id)
                        ->update([
                            'paid_amount' => ($booking_detail->paid_amount + $request->input('amount')),
                            'payment_request_id' => $response['id'],
                            'paymentStatus' => 2,
                        ]);
                    
                   header('Location: ' . $response['longurl']);
                   exit();
            }catch (Exception $e) {
               print('Error: ' . $e->getMessage());
            } 
    }

    public function paySuccess(Request $request, $booking_id) {

        try {
    
           $api = new \Instamojo\Instamojo(
               config('services.instamojo.api_key'),
               config('services.instamojo.auth_token'),
               config('services.instamojo.url')
           );
    
           $response = $api->paymentRequestStatus(request('payment_request_id'));
    
           if( !isset($response['payments'][0]['status']) ) {
                return redirect()->route('pening_payment_failed');
           } else if($response['payments'][0]['status'] != 'Credit') {
                return redirect()->route('pening_payment_failed');
           } 
         }catch (\Exception $e) {
            return redirect()->route('pening_payment_failed');
        }
       
        if($response['payments'][0]['status'] == 'Credit') {

            $user_id = Auth::id();
            
            $user_detail = DB::table('users')
                ->where('id', $user_id)
                ->first();

            $package_booking_detail = DB::table('package_booking_basic_details')
                ->where('id', $booking_id)
                ->first();

            $remaining_amount = $package_booking_detail->payableAmount - $package_booking_detail->paid_amount;

            if ($remaining_amount > 0) {
                $remaining_amount = $remaining_amount;
                $paymentStatus = 0;
            } else {
                $remaining_amount = 0;
                $paymentStatus = 1;
            }

            DB::table('package_booking_basic_details')
                ->where('id', $booking_id)
                ->update([
                    'payment_id' => $response['payments'][0]['payment_id'],
                    'remaining_amount' => $remaining_amount,
                    'paymentStatus' => $paymentStatus
                ]);
        } 

        return redirect()->route('pending_thankyou');
    }

    public function paymentFailed()
    {
        return view('account.payment.payment_failed');
    }

    public function thankyou()
    {
        return view('account.payment.thank_you');
    }
}
