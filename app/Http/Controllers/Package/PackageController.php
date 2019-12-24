<?php

namespace App\Http\Controllers\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PHotels\PHotels;
use App\Models\PCoupon\PCoupon;
use App\Models\PType\PType;
use App\Models\PImages\PImages;
use App\Models\Package\Package;
use App\Models\PPackage\PPackage;
use App\Models\PBBDetails\PBBDetails;
use App\Models\PBTDetails\PBTDetails;
use App\Models\PFacility\PFacility;
use App\Models\PFRelation\PFRelation;
use App\Models\PHotels\PHRelation;
use App\Models\PItenary\PItenary;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;
use DB;
use Auth;
use Session;

class PackageController extends Controller
{
    public function packages() {

    	$package     = new Package;
    	$pfrelation  = new PFRelation;
    	$packageData = $package->orderBy(DB::raw('RAND()'))
                                ->take(3)
                                ->get();

        foreach ($packageData as $key => $value) {
            
            $url = route('package_banner', ['file_name' => $value['coverImage']]);

            $pfrelationData = $pfrelation->where('packageId', $value['id'])
            								->orderBy('packageFacilityId','ASC')
                                            ->get();
                                            
            $package_price = DB::table('package_price')
                ->where('packageId', $value['id'])
                ->orderBy('totalPersons', 'DESC')
                ->first();

            $data[] = [
                'packageId'    => $value['id'],
                'packageTitle' => $value['packageTitle'],
                'url'          => $url,
                'offer'        => $value['offer'],
                'price'        => isset($package_price->amount)? $package_price->amount: '',
                'desc'         => substr($value['packageDesc'], 0, 150),
                'duration'     => $value['totalDays']."D/".$value['totalNights']."N",
                'location'     => $value['location'],
                'rating'       => $value['rating'],
                'pfrelation'   => $pfrelationData
            ];
        }

        $packageSuggessData = $package->orderBy('id', 'DESC')
                                		->take(3)
                                		->get();

        foreach ($packageSuggessData as $key => $value) {
            
            $url = route('package_banner', ['file_name' => $value['coverImage']]);

            $spdata[] = [
                'packageSId'   => $value['id'],
                'url'          => $url,
                'desc'         => substr($value['packageDesc'], 0, 70),
                'location'     => $value['location'],
                'rating'       => $value['rating']
            ];
        }

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


    	return view('package.package_list', ['packageData' => $data, 'packageSuggessData' => $spdata, 'packageDurationData' => $packageDurationData, 'packageLocationData' => $packageLocationData]);
    }

    public function packageBanner ($file_name) {

        $path = public_path('assets/package_banner/thumnail_2/'.$file_name);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function package_details ($packageId) {

        $package         = new Package;
        $package_type    = new PType;
        $phrelation      = new PHRelation;
        $photels         = new PHotels;
        $package_itenary = new PItenary;
        $package_images  = new PImages;
        $ppackage        = new PPackage;

        $packageData = $package->where('package.id', $packageId)
                                ->join('package_type', 'package.packageType', '=', 'package_type.id')
                                ->select('package_type.packageType', 'package.id', 'package.location', 'package.packageId', 'package.duration', 'package.rating', 'package.packageDesc', 'package.offer', 'package.includeFacility', 'package.excludeFacility', 'package.termCondition', 'package.longitude', 'package.latitude', 'package.totalDays')
                                ->get();
                            
        $package_price = DB::table('package_price')
                            ->where('packageId', $packageId)
                            ->orderBy('totalPersons', 'ASC')
                            ->first();

        $photelsBudgetData = $phrelation->where('package_hotel_relation.packageId', $packageId)
                                ->join('package_hotels', 'package_hotel_relation.hotelId', '=', 'package_hotels.id')
                                ->where('package_hotels.hotelType', 1)
                                ->select('package_hotels.*')
                                ->orderBy('package_hotels.hotelType', 'ASC')
                                ->get();

        $photelsDeluxData = $phrelation->where('package_hotel_relation.packageId', $packageId)
                                ->join('package_hotels', 'package_hotel_relation.hotelId', '=', 'package_hotels.id')
                                ->where('package_hotels.hotelType', 2)
                                ->select('package_hotels.*')
                                ->orderBy('package_hotels.hotelType', 'ASC')
                                ->get();

        $packageItenaryData = $package_itenary->where('packageId', $packageId)
                                                ->get();

        foreach ($packageItenaryData as $key => $value) {

            $url = route('itenary_images', ['file_name' => $value['image']]);
            
            $data[] = [
                'day'   => 'Day : '.$value['days'],
                'title' => $value['title'],
                'desc'  => $value['desc'],
                'url'   => $url,
                'rating'=> $packageData[0]->rating
            ];
        }

        $packageImagesData = $package_images->where('packageId', $packageId)
                                                ->get();

        foreach ($packageImagesData as $key => $value) {

            $url = route('slider_images', ['file_name' => $value['image']]);
            
            $pidata[] = [
                'url'   => $url,
            ];
        }

        $popularPackageData = $ppackage
                                    ->join('package', 'popular_package.package_id', '=', 'package.id')
                                ->select('popular_package.package_id', 'package.packageDesc', 'package.coverImage', 'package.duration', 'package.location')
                                ->get();

        foreach ($popularPackageData as $key => $value) {

            $url = route('package_banner', ['file_name' => $value['coverImage']]);
            
            $ppdata[] = [
                'id'          => $value['package_id'],
                'url'         => $url,
                'packageDesc' => substr($value['packageDesc'], 0, 80),
                'duration'    => $value['duration'],
                'location'    => $value['location'],
            ];
        }

        $total_persons_list = DB::table('package_price')
                            ->where('packageId', $packageId)                 
                            ->orderBy('totalPersons', 'ASC')
                            ->get();

        return view('package.package_details', ['packageData' => $packageData, 'package_price' => $package_price->amount, 'photelsBudgetData' => $photelsBudgetData, 'photelsDeluxData' => $photelsDeluxData, 'itenaryData' => $data, 'sliderData' => $pidata, 'popularPackageData' => $ppdata, 'total_persons_list' => $total_persons_list, 'min_person' => $package_price->totalPersons]);
    }

    public function itenaryImages ($file_name) {

        $path = public_path('assets/itenary_banner/'.$file_name);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function sliderImages ($file_name) {

        $path = public_path('assets/package_slider/'.$file_name);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function package_price_change (Request $request) {
        $photels = new PHotels;
        $package         = new Package;

        $packageData = $package->find($request->input('packageId'));
        $photelsData = $photels->find($request->input('hotelId'));

        $package_price = DB::table('package_price')
                            ->where('packageId', $request->input('packageId'))
                            ->orderBy('totalPersons', 'DESC')
                            ->first();

        if(!empty($packageData->offer)){
            $discount      = ($package_price->amount * $packageData->offer) / 100;
            $selling_price = ($package_price->amount - $discount);
            $selling_price = $selling_price + $photelsData->price;
        }
        else
            $selling_price = $package_price->amount + $photelsData->price;

        print ($package_price->amount + $photelsData->price).",".$selling_price;
    }

    public function package_booking_form (Request $request) {

        $package     = new Package;
        // $photels     = new PHotels;
        $pcoupon     = new PCoupon;
        $packageData = $package->find($request->package_id);
        // $photelsData = $photels->find($request->hotel_id);
        $pcouponData = $pcoupon->all();

        if($request->has('total_persons_list')){
            $package_price = DB::table('package_price')
                            ->where('packageId', $request->package_id)
                            ->where('totalPersons', $request->input('total_persons_list'))
                            ->first();
        }
        // } else {
        //     $package_price = DB::table('package_price')
        //                     ->where('packageId', $request->package_id)
        //                     ->orderBy('totalPersons', 'DESC')
        //                     ->first();
        // }
        
        $pdata = [
            'packageId'    => $request->input('package_id'),
            'adults'       => $request->input('total_persons_list'),
            'location'     => $packageData->location,
            'packagePrice' => $package_price->amount,
            'offer'        => $packageData->offer,
            'couponNumber' => $pcouponData[0]->couponNumber,
            'couponId'     => $pcouponData[0]->id,
            'totalDays'    => $packageData->totalDays,
            'totalNights'  => $packageData->totalNights
        ];

        // $phdata = [
            // 'hotelId'    => $request->hotel_id,
            // 'hotelPrice' => $photelsData->price,
        // ];

        // if (Auth::check()) 
            return view('package.package_booking', ['packageData' => $pdata, 'hotel_type' => $request->input('hotel_type'), 'start_date' => $request->input('start_date_text'), 'end_date' => $request->input('end_date_text')]);
        // else 
            // return redirect()->route('login');
    }
    
    public function coupon_price_calculating (Request $request) {

        $package = new Package;
        $pcoupon = new PCoupon;
        // $photels = new PHotels;

        $packageData = $package->find($request->input('packageId'));
        // $photelsData = $photels->find($request->input('hotelId'));
        $pcouponData = $pcoupon->all();

        $packagePrice = DB::table('package_price')
            ->where('packageId', $request->input('packageId'))
            ->where('totalPersons', $request->input('total_persons_list'))
            ->get();

        /** Selling Price **/
        if(!empty($packageData->offer)) {
            $discount      = ($packagePrice[0]->amount * $packageData->offer) / 100;
            $selling_price = ($packagePrice[0]->amount - $discount);
            $selling_price = $selling_price;
        }
        else {
            $selling_price = $packagePrice[0]->amount;
        }
        /** End of Selling Price **/

        /** Coupon Amount **/
        if ($pcouponData[0]->status == 1) {
            if($packageData->isApplicable == 1) {
                $couponAmount  = ($selling_price * $pcouponData[0]->flatAmount) / 100;
                $selling_price = $selling_price - $couponAmount;
                $status        = 1;
            } else 
                $status = 0;
        } else 
            $status = 0;
        /** End of Coupon Amount **/

        /** GST **/
        $gstAmount = ($selling_price * 5) / 100;
        /** End of GST **/

        /****/
        $totalPayAmount = $selling_price + $gstAmount;
        /****/
        print $selling_price.",".$gstAmount.",".$totalPayAmount.",".$status;
    }

    public function package_booking (Request $request) {

        // $request->validate([
        //     'start_date' => 'required',
        //     'total_persons' => 'required',
        //     'payableAmount' => 'required',
        //     'packageId' => 'required',
        //     'couponId' => 'required',
        //     'payment_radio' => 'required',
        //     'hotel_type' => 'required',
        //     'gender' => 'required',
        //     'paid_amount' => 'required',
        // ]);

        // dd($request);

        $pbbdetails = new PBBDetails;
        $txtNo      = uniqid('txt');

        $pbbdetails->userId      = Auth::id();
        $pbbdetails->txtNo       = $txtNo;
        $pbbdetails->startDate   = $request->input('start_date');
        $pbbdetails->totalPersons = $request->input('total_persons');
        $pbbdetails->payableAmount = $request->input('payableAmount');
        $pbbdetails->packageId   = $request->input('packageId');
        $pbbdetails->couponId    = $request->input('couponId');
        $pbbdetails->paymentType = $request->input('payment_radio');

        $package_hotels = DB::table('package_hotel_relation')
            ->where('packageId', $request->input('packageId'))
            ->where('hotelType', $request->input('hotel_type'))
            ->get();

        if($pbbdetails->save()) {

            for ($i=0; $i < count($request->input('t_name')); $i++) { 
                DB::table('package_booking_traveller_details')->insert([
                    'pbbdId'    => $pbbdetails->id,
                    'txtNo'     => $txtNo,
                    't_name'    => ucwords(strtolower($request->input('t_name')[$i])),
                    't_con_no'  => isset($request->input('t_con_no')[$i])? $request->input('t_con_no')[$i]: "",
                    't_email'   => isset($request->input('t_email')[$i])? $request->input('t_email')[$i]: "",
                    't_age'     => $request->input('t_age')[$i],
                    'gender'    => ucwords(strtolower($request->input('gender')[$i])),
                    'created_at'=> now()
                ]);
            }

            foreach ($package_hotels as $key => $item) {
                DB::table('package_hotel_booking')
                    ->insert([
                        'bookingId' => $pbbdetails->id,
                        'packageId' => $request->input('packageId'),
                        'hotelType' => $request->input('hotel_type'),
                        'hotelId'   => $item->hotelId
                    ]);
            }

            $user_detail = DB::table('users')
                ->where('id', Auth::id())
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
                   "amount" => $request->input('paid_amount'),
                   "buyer_name" => $user_detail->name,
                   "send_email" => true,
                   "email" => $user_detail->email,
                   "phone" => $user_detail->mobile_no,
                   "redirect_url" => "http://127.0.0.1:8000/pay-success/".$pbbdetails->id,
                ));

                   DB::table('package_booking_basic_details')
                        ->where('id', $pbbdetails->id)
                        ->update([
                            'paid_amount' => $request->input('paid_amount'),
                            'payment_request_id' => $response['id'],
                            'paymentStatus' => 2,
                        ]);
                    
                   header('Location: ' . $response['longurl']);
                   exit();
            }catch (Exception $e) {
               print('Error: ' . $e->getMessage());
            } 
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

                DB::table('package_booking_basic_details')
                    ->where('id', $booking_id)
                    ->delete();

                DB::table('package_booking_traveller_details')
                    ->where('pbbdId', $booking_id)
                    ->delete();

                return redirect()->route('payment_failed');
           } else if($response['payments'][0]['status'] != 'Credit') {

                DB::table('package_booking_basic_details')
                    ->where('id', $booking_id)
                    ->delete();

                DB::table('package_booking_traveller_details')
                    ->where('pbbdId', $booking_id)
                    ->delete();

                return redirect()->route('payment_failed');
           } 
         }catch (\Exception $e) {

            DB::table('package_booking_basic_details')
                ->where('id', $booking_id)
                ->delete();

            DB::table('package_booking_traveller_details')
                ->where('pbbdId', $booking_id)
                ->delete();

            return redirect()->route('payment_failed');
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

        return redirect()->route('thankyou', ['txtNo' => $package_booking_detail->txtNo]);
    }

    public function paymentFailed()
    {
        return view('package.package_failed');
    }

    public function thankyou($txtNo)
    {
        return view('package.package_thank_you', ['txtNo' => $txtNo]);
    }

    public function package_search (Request $request) {

        $request->validate([
            'location' => 'required'
            // 'duration' => 'required'
        ]);
        
        $package     = new Package;
        $pfrelation  = new PFRelation;
        DB::enableQueryLog();

        $result      = $package->where('location', $request->input('location'))
                                // ->where('duration', $request->input('duration'))
        
        ->where(function($query) use ($request) {
            if ($request->has('price')) {
                
                if (count($request->input('price')) > 0) {
                    
                    $count_price = 1;
                    for ($i=0; $i < count($request->input('price')); $i++){
        
                        $ext  = explode('&', $request->input('price')[$i]);
                        $from = $ext[1];
                        $to   = $ext[0];
     
                        if (is_numeric($to) && ($from != '1' && $from != '0')) {

                            if ($count_price == 1) {
                                $query->whereBetween('price', [$from, $to]);
                            }else{
                                $query->orWhereBetween('price', [$from, $to]);
                            }
                        } else if (is_numeric($from) && $from == "1") {

                            if ($count_price == 1) {
                                $query->where('price', '>', $to);
                            }else{
                                $query->orWhere('price', '>', $to);
                            }

                        } else if (is_numeric($from) && $from == "0") {
                            if ($count_price == 1) {
                                $query->where('price', '<', $to);
                            }else{
                                $query->orWhere('price', '<', $to);   
                            }
                        }
                        $count_price++;
                    }
                }
            }
        });

        $packageData = $result->get();

        $data = [];

        if (count($packageData) > 0) {
            
            foreach ($packageData as $key => $value) {
            
                $url = route('package_banner', ['file_name' => $value['coverImage']]);

                $pfrelationData = $pfrelation->where('packageId', $value['id'])
                                                ->orderBy('packageFacilityId','ASC')
                                                ->get();
                                                
                $package_price = DB::table('package_price')
                    ->where('packageId', $value['id'])
                    ->orderBy('totalPersons', 'DESC')
                    ->first();

                $data[] = [
                    'packageId'    => $value['id'],
                    'packageTitle' => $value['packageTitle'],
                    'url'          => $url,
                    'offer'        => $value['offer'],
                    'price'        => isset($package_price->amount)? $package_price->amount: '',
                    'desc'         => substr($value['packageDesc'], 0, 150),
                    'duration'     => $value['totalDays']."D/".$value['totalNights']."N",
                    'location'     => $value['location'],
                    'rating'       => $value['rating'],
                    'pfrelation'   => $pfrelationData
                ];
            }
        }

        $packageSuggessData = $package->orderBy('id', 'DESC')
                                        ->take(3)
                                        ->get();

        foreach ($packageSuggessData as $key => $value) {
            
            $url = route('package_banner', ['file_name' => $value['coverImage']]);

            $spdata[] = [
                'packageSId'   => $value['id'],
                'url'          => $url,
                'desc'         => substr($value['packageDesc'], 0, 70),
                'location'     => $value['location'],
                'rating'       => $value['rating']
            ];
        }

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

        return view('package.package_list', ['packageData' => $data, 'packageSuggessData' => $spdata, 'packageDurationData' => $packageDurationData, 'packageLocationData' => $packageLocationData]);
    }


//     function getRealQuery($query, $dumpIt = false)
// {
//     $params = array_map(function ($item) {
//         return "'{$item}'";
//     }, $query->getBindings());
//     $result = str_replace_array('\?', $params, $query->toSql());
//     if ($dumpIt) {
//         dd($result);
//     }
//     return $result;
// }
}
