<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PHotels\PHotels;
use App\Models\PCoupon\PCoupon;
use App\Models\PType\PType;
use App\Models\PImages\PImages;
use App\Models\PBBDetails\PBBDetails;
use App\Models\PBTDetails\PBTDetails;
use App\Models\Package\Package;
use App\Models\PPackage\PPackage;
use App\Models\PFacility\PFacility;
use App\Models\PFRelation\PFRelation;
use App\Models\PHotels\PHRelation;
use App\Models\PItenary\PItenary;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;
use DB;

class HolidaysController extends Controller
{
   //Package Hotel
   public function showPHotelsForm(Request $request) 
   {
   		return view('admin.auth.holidays.hotels.new_hotel');
   }

   public function addPHotels (Request $request) 
   {

    	$request->validate([
	        'hotel_type'    => 'bail|required',
	        'hotel_name'    => 'required',
	        'hotel_address' => 'required',
            'price'         => 'required'
	    ],
		[
	        'hotel_type.required'    => 'The hotel type is required',
	        'hotel_name.required'    => 'The hotel name is required',
	        'hotel_address.required' => 'The hotel address is required',
            'price.required'         => 'The price is required',
	    ]);

    	$photels = new PHotels;

    	$photels->hotelType    = $request->input('hotel_type');
        $photels->hotelName    = ucwords(strtolower($request->input('hotel_name')));
        $photels->hotelAddress = ucwords(strtolower($request->input('hotel_address')));
        $photels->rating       = 3;
        $photels->price        = $request->input('price');

        if($photels->save()) 
            return redirect()->route('admin.p_hotel')->with('msg', 'Hotel has been added successfully');
        else
            return redirect()->route('admin.p_hotel')->with('msg', 'Something wrong while adding');
   }

   public function allPHotels(Request $request) 
   {
   		return view('admin.auth.holidays.hotels.all_hotel');
   }

   public function allPHotelsData(Request $request) {

        $photels = new PHotels;

        $columns = array( 
                            0 => 'id', 
                            1 => 'hotelType',
                            2 => 'hotelName',
                            3 => 'hotelAddress',
                            4 => 'price',
                            5 => 'rating',
                            6 => 'action',
                        );

        $totalData = $photels->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {            
            
            $photelsData = $photels
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            if($search == "Budget")
                $val = "1";
            else
                $val = "2";

            $photelsData = $photels
                            ->orWhere('hotelType', 'LIKE',"%{$val}%")
                            ->orWhere('hotelName', 'LIKE',"%{$search}%")
                            ->orWhere('hotelAddress', 'LIKE',"%{$search}%")
                            ->orWhere('price', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $photels
                            ->orWhere('hotelType', 'LIKE',"%{$val}%")
                            ->orWhere('hotelName', 'LIKE',"%{$search}%")
                            ->orWhere('hotelAddress', 'LIKE',"%{$search}%")
                            ->orWhere('price', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($photelsData)) {

            $cnt = 1;

            foreach ($photelsData as $single_data) {

                if($single_data->status == 0)
                    $status = "&emsp;<a href=\"".route('admin.p_hotel_change_status', ['pHotelId' => $single_data->id, 'status' => 1])."\" class=\"btn btn-warning form-text-element\">In-Active</a>";
                else
                    $status = "&emsp;<a href=\"".route('admin.p_hotel_change_status', ['pHotelId' => $single_data->id, 'status' => 0])."\" class=\"btn btn-warning form-text-element\">Active</a>";

                if($single_data->hotelType == 1)
                    $val = "Budget";
                else
                    $val = "Delux";

                $nestedData['id']           = $cnt;
                $nestedData['hotelType']    = $val;
                $nestedData['hotelName']    = $single_data->hotelName;
                $nestedData['hotelAddress'] = $single_data->hotelAddress;
                $nestedData['price']        = $single_data->price;
                $nestedData['rating']       = $single_data->rating;
                $nestedData['action']       = "<a href=\"".route('admin.p_hotel_edit_form', ['pHotelId' => $single_data->id])."\" class=\"btn btn-primary form-text-element\">Edit</a>&emsp;".$status;

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function pHotelsChangeStatus($pHotelId, $status) {

        $photels = new PHotels;

        $photels->where('id', $pHotelId)->update(['status' => $status]);

        return redirect()->route('admin.all_p_hotel');
    }

    public function showPHotelsEditForm($pHotelId) 
   {
        $photels     = new PHotels;
        $photelsData = $photels->find($pHotelId);

        return view('admin.auth.holidays.hotels.edit_hotel', ['photelsData' => $photelsData]);
   }

   public function updatePHotels (Request $request, $pHotelId) 
   {

        $request->validate([
            'hotel_type'    => 'bail|required',
            'hotel_name'    => 'required',
            'hotel_address' => 'required',
            'price'         => 'required',
        ],
        [
            'hotel_type.required'    => 'The hotel type is required',
            'hotel_name.required'    => 'The hotel name is required',
            'hotel_address.required' => 'The hotel address is required',
            'price.required'         => 'The price is required',
        ]);

        $photels      = new PHotels;
        $updatePHotel = $photels->where('id', $pHotelId)->update(['hotelType' => $request->input('hotel_type'), 'hotelName' => ucwords(strtolower($request->input('hotel_name'))), 'hotelAddress' => ucwords(strtolower($request->input('hotel_address'))), 'price' => $request->input('price')]);

        if($updatePHotel)
            return redirect()->route('admin.p_hotel_edit_form', ['pHotelId' => $pHotelId])->with('msg', 'Hotel has been updated successfully');
        else
            return redirect()->route('admin.p_hotel_edit_form', ['pHotelId' => $pHotelId])->with('msg', 'Something wrong while updating');
   }
   //End of Package Hotel

   //Package Coupon
   public function showPCouponForm(Request $request) 
   {
        return view('admin.auth.holidays.coupon.new_coupon');
   }

   public function addPCoupon (Request $request) 
   {

        $request->validate([
            'coupon_number'=> 'bail|required',
            'flat_amount'  => 'required',
        ],
        [
            'coupon_number.required' => 'The coupon number is required',
            'flat_amount.required'   => 'The flat amount is required',
        ]);

        $pcoupon = new PCoupon;

        $pcoupon->couponNumber = $request->input('coupon_number');
        $pcoupon->flatAmount   = $request->input('flat_amount');

        if($pcoupon->save()) 
            return redirect()->route('admin.p_coupon')->with('msg', 'Coupon has been added successfully');
        else
            return redirect()->route('admin.p_coupon')->with('msg', 'Something wrong while adding');
   }

   public function allPCoupon(Request $request) 
   {
        return view('admin.auth.holidays.coupon.all_coupon');
   }

   public function allPCouponData(Request $request) {

        $pcoupon = new PCoupon;

        $columns = array( 
                            0 => 'id', 
                            1 => 'couponNumber',
                            2 => 'flatAmount',
                            3 => 'action',
                        );

        $totalData = $pcoupon->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {            
            
            $pcouponData = $pcoupon
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            $pcouponData = $pcoupon
                            ->Where('couponNumber', 'LIKE',"%{$search}%")
                            ->orWhere('flatAmount', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $pcoupon
                            ->Where('couponNumber', 'LIKE',"%{$search}%")
                            ->orWhere('flatAmount', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($pcouponData)) {

            $cnt = 1;

            foreach ($pcouponData as $single_data) {

                if($single_data->status == 0)
                    $status = "&emsp;<a href=\"".route('admin.p_coupon_change_status', ['pCouponId' => $single_data->id, 'status' => 1])."\" class=\"btn btn-warning form-text-element\">In-Active</a>";
                else
                    $status = "&emsp;<a href=\"".route('admin.p_coupon_change_status', ['pCouponId' => $single_data->id, 'status' => 0])."\" class=\"btn btn-warning form-text-element\">Active</a>";

                $nestedData['id']           = $cnt;
                $nestedData['couponNumber'] = $single_data->couponNumber;
                $nestedData['flatAmount']   = $single_data->flatAmount."%";
                $nestedData['action']       = "<a href=\"".route('admin.p_coupon_edit_form', ['pCouponId' => $single_data->id])."\" class=\"btn btn-primary form-text-element\">Edit</a>&emsp;".$status;

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function pCouponChangeStatus($pCouponId, $status) {

        $pcoupon = new PCoupon;

        $pcoupon->where('id', $pCouponId)->update(['status' => $status]);

        return redirect()->route('admin.all_p_coupon');
    }

    public function showPCouponEditForm($pCouponId) 
    {
        $pcoupon     = new PCoupon;
        $pcouponData = $pcoupon->find($pCouponId);

        return view('admin.auth.holidays.coupon.edit_coupon', ['pcouponData' => $pcouponData]);
    }

    public function updatePCoupon (Request $request, $pCouponId) 
    {

        $request->validate([
            'coupon_number'=> 'bail|required',
            'flat_amount'  => 'required',
        ],
        [
            'coupon_number.required' => 'The coupon number is required',
            'flat_amount.required'   => 'The flat amount is required',
        ]);

        $pcoupon       = new PCoupon;
        $updatePCoupon = $pcoupon->where('id', $pCouponId)->update(['couponNumber' => $request->input('coupon_number'), 'flatAmount' => $request->input('flat_amount')]);

        if($updatePCoupon)
            return redirect()->route('admin.p_coupon_edit_form', ['pCouponId' => $pCouponId])->with('msg', 'Coupon has been updated successfully');
        else
            return redirect()->route('admin.p_coupon_edit_form', ['pCouponId' => $pCouponId])->with('msg', 'Something wrong while updating');
    } 
    //End of Package Coupon

    //Package Type
    public function showPTypeForm(Request $request) 
    {
        return view('admin.auth.holidays.package_type.new_package_type');
    }

    public function addPType (Request $request) 
    {

        $request->validate([
            'package_type'=> 'bail|required',
        ],
        [
            'package_type.required' => 'The Package Type is required',
        ]);

        $ptype               = new PType;
        $ptype->packageType = ucwords(strtolower($request->input('package_type')));

        if($ptype->save()) 
            return redirect()->route('admin.p_type')->with('msg', 'Package Type has been added successfully');
        else
            return redirect()->route('admin.p_type')->with('msg', 'Something wrong while adding');
    }

    public function allPType(Request $request) 
    {
        return view('admin.auth.holidays.package_type.all_package_type');
    }

    public function allPTypeData(Request $request) {

        $ptype = new PType;

        $columns = array( 
                            0 => 'id', 
                            1 => 'packageType',
                            2 => 'action',
                        );

        $totalData = $ptype->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {            
            
            $ptypeData = $ptype
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            $ptypeData = $ptype
                            ->Where('packageType', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = $pcoupon
                            ->Where('packageType', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($ptypeData)) {

            $cnt = 1;

            foreach ($ptypeData as $single_data) {

                $nestedData['id']          = $cnt;
                $nestedData['packageType'] = $single_data->packageType;
                $nestedData['action']      = "<a href=\"".route('admin.p_type_edit_form', ['pTypeId' => $single_data->id])."\" class=\"btn btn-primary form-text-element\">Edit</a>&emsp;";

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function showPTypeEditForm($pTypeId) 
    {
        $ptype     = new PType;
        $ptypeData = $ptype->find($pTypeId);

        return view('admin.auth.holidays.package_type.edit_pacakge_type', ['ptypeData' => $ptypeData]);
    }

    public function updatePType (Request $request, $pTypeId) 
    {

        $request->validate([
            'package_type'=> 'bail|required',
        ],
        [
            'package_type.required' => 'The Package Type is required',
        ]);

        $ptype       = new PType;
        $updatePType = $ptype->where('id', $pTypeId)->update(['packageType' => $request->input('package_type')]);

        if($updatePType)
            return redirect()->route('admin.p_type_edit_form', ['pTypeId' => $pTypeId])->with('msg', 'Package Type has been updated successfully');
        else
            return redirect()->route('admin.p_type_edit_form', ['pTypeId' => $pTypeId])->with('msg', 'Something wrong while updating');
    }
    //End of Package Type

    //Package
    public function showPForm(Request $request) 
    {
        $ptype     = new PType;
        $ptypeData = $ptype->all();

        $pfacility     = new PFacility;
        $pfacilityData = $pfacility->all();

        return view('admin.auth.holidays.packages.new_package', ['ptypeData' => $ptypeData, 'pfacilityData' => $pfacilityData]);
    }

    public function addPBasicInfo (Request $request) 
    {

        $request->validate([
            'package_id'      => 'bail|required',
            'package_category'=> 'required',
            'package_type'    => 'required|numeric',
            'package_title'   => 'required',
            'package_desc'    => 'required',
            'total_persons'   => 'required',
            'amount'          => 'required',
            'offer'           => 'required',
            'duration'        => 'required',
            'total_days'      => 'required|numeric',
            'total_nights'    => 'required|numeric',
            'location'        => 'required',
            'longitude'       => 'required',
            'latitude'        => 'required',
            'cover_img'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'is_applicable'   => 'required|numeric',
        ],
        [
            'package_category.required'=> 'The Package Category is required',
            'package_id.required'      => 'The Package ID is required',
            'package_type.required'    => 'The Package Type is required',
            'package_title.required'   => 'The Package Title is required',
            'package_desc.required'    => 'The Package Description is required',
            'total_persons.required'   => 'The Total Persons is required',
            'amount.required'          => 'The Amount is required',
            'offer.required'           => 'The offer is required',
            'duration.required'        => 'The duration is required',
            'total_days.required'      => 'The Total Days is required',
            'total_nights.required'    => 'The Total Night is required',
            'location.required'        => 'The location is required',
            'longitude.required'       => 'The longitude is required',
            'latitude.required'        => 'The latitude is required',
            'cover_img.required'       => 'The Cover Image is required',
            'is_applicable.required'   => 'The Coupon applicable is required',
        ]);

        $package      = new Package;
        $pfr_obj      = new PFRelation;
        $packageIdChk = $package->where('packageId', $request->input('package_id'))
                                        ->count();

        if($packageIdChk == 0) {

            if($request->hasFile('cover_img')) {

                $coverImage = $request->file('cover_img');
                $fileName   = time().".jpg";

                $imageResize = Image::make($coverImage->getRealPath());              
                $imageResize->resize(700, 400);

                if(!File::exists(public_path()."/assets"))
                    File::makeDirectory(public_path()."/assets");

                if(!File::exists(public_path()."/assets/package_banner"))
                    File::makeDirectory(public_path()."/assets/package_banner");

                if(!File::exists(public_path()."/assets/package_banner/thumnail_1"))
                    File::makeDirectory(public_path()."/assets/package_banner/thumnail_1");

                $imageResize->save(public_path("assets/package_banner/thumnail_1/".$fileName));

                $imageResize = Image::make($coverImage->getRealPath());              
                $imageResize->resize(350, 300);

                if(!File::exists(public_path()."/assets"))
                    File::makeDirectory(public_path()."/assets");

                if(!File::exists(public_path()."/assets/package_banner"))
                    File::makeDirectory(public_path()."/assets/package_banner");

                if(!File::exists(public_path()."/assets/package_banner/thumnail_2"))
                    File::makeDirectory(public_path()."/assets/package_banner/thumnail_2");

                $imageResize->save(public_path("assets/package_banner/thumnail_2/".$fileName));

                $package->packageCategory= $request->input('package_category');
                $package->packageId      = $request->input('package_id');
                $package->packageType    = $request->input('package_type');
                $package->packageTitle   = $request->input('package_title');
                $package->packageDesc    = $request->input('package_desc');
                $package->offer          = $request->input('offer');
                $package->duration       = ucwords(strtolower($request->input('duration')));
                $package->totalDays      = $request->input('total_days');
                $package->totalNights    = $request->input('total_nights');
                $package->location       = ucwords(strtolower($request->input('location')));
                $package->longitude      = $request->input('longitude');
                $package->latitude       = $request->input('latitude');
                $package->rating         = 3;
                $package->coverImage     = $fileName;
                $package->isApplicable   = $request->input('is_applicable');

                if($package->save()) {

                    /** Start of Adding Package Facility **/
                    if ($request->has('package_facility') > 0) {
                
                        foreach ($request->package_facility as $value)
                            $pfr_obj->insert([
                                'packageId' => $package->id,
                                'packageFacilityId' => $value,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                    }
                    /** End of Adding Package Facility **/

                    /** Start of Adding Package Facility **/
                    if ($request->has('total_persons') && $request->has('amount')) {
                
                        for($i = 0; $i < count($request->input('total_persons')); $i++){
                            DB::table('package_price')->insert([
                                'packageId' => $package->id,
                                'totalPersons' => $request->input('total_persons')[$i],
                                'amount' => $request->input('amount')[$i],
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                    /** End of Adding Package Facility **/

                    return view('admin.auth.holidays.packages.new_package_section', ['packageId' => $package->id, 'packageTitle' => $package->packageTitle, 'packageFakeId' => $package->packageId]);
                }
                else{
                    unlink(public_path("assets/package_cover_img/".$fileName));
                    return redirect()->route('admin.p')->with('msg', 'Something wrong while adding');
                }

            } else
                return redirect()->route('admin.p')->with('msg', 'Please ! upload image.');
        } else
            return redirect()->route('admin.p')->with('msg', 'Package ID already present.');
    }

    /** Start Package Slider **/
    public function showUploadPImagesForm($packageId) 
    {
        $package        = New Package;
        $packageDetails = $package->find($packageId);

        return view('admin.auth.holidays.packages.new_package_images', ['packageId' => $packageId, 'packageTitle' => $packageDetails['packageTitle'], 'packageFakeId' => $packageDetails['packageId']]);
    }

    public function uploadPImages(Request $request, $packageId) 
    {
        $package            = New Package;
        $package_images_obj = New PImages;
        $packageImageCnt    = $package_images_obj->where('packageId', $packageId)
                                                ->count();

        if ($packageImageCnt > 0) {

            $packageDetails = $package->find($packageId);
            $msg            = "Slider images already uploaded";
        } else{

            if($request->hasFile('package_multiple_file')) {

                $i = 0;

                foreach($request->file('package_multiple_file') as $file) {

                    $image     = $file;
                    $file_name = time().$i.".jpg";

                    $image_resize = Image::make($image->getRealPath());              
                    $image_resize->resize(850, 450);

                    if(!File::exists(public_path()."/assets"))
                        File::makeDirectory(public_path()."/assets");

                    if(!File::exists(public_path()."/assets/package_slider"))
                        File::makeDirectory(public_path()."/assets/package_slider");

                    $image_resize->save(public_path("assets/package_slider/".$file_name));

                    $i++;
                            
                    $data['packageId']  = $packageId;
                    $data['image']      = $file_name;
                    $data['created_at'] = now();
                    $data['updated_at'] = now();

                    DB::table('package_images')->insert($data);
                }

                $msg = "Images has been uploaded successfully.";
            } else 
                $msg = "Please ! select images";
        }

        $packageDetails = $package->find($packageId);

        return redirect()->back()->with('msg', $msg);
    }
    /** End of Package Slider **/

    /** Start of Package Facility **/
    public function showUploadPFacilityForm($packageId) 
    {
        $package        = New Package;
        $packageDetails = $package->find($packageId);

        return view('admin.auth.holidays.packages.new_package_facility', ['packageId' => $packageId, 'packageTitle' => $packageDetails['packageTitle'], 'packageFakeId' => $packageDetails['packageId']]);
    }

    public function uploadPFacility(Request $request, $packageId) 
    {
        $request->validate([
            'package_include_facility'  => 'bail|required',
            'package_excluded_facility' => 'required',
            'terms_and_condition'       => 'required',
        ],
        [
            'package_include_facility.required'  => 'The package included facility is required',
            'package_excluded_facility.required' => 'The Package excluded facility is required',
            'terms_and_condition.required'       => 'The terms and condition is required', 
        ]);

        $package        = New Package;
        $packageUpdate  =  $package->where('id', $packageId)
                                    ->update(['includeFacility' => $request->input('package_include_facility'), 'excludeFacility' => $request->input('package_excluded_facility'), 'termCondition' => $request->input('terms_and_condition')]);
        $packageDetails = $package->find($packageId);

        if ($packageUpdate)
            return redirect()->route('admin.upload_p_facility_form', ['packageId' => $packageId])->with('msg', 'Facility has been addded successfully');
        else
            return redirect()->route('admin.upload_p_facility_form', ['packageId' => $packageId])->with('msg', 'Something wrong while adding');
    }
    /** End of Package Facility **/

    /** Start of Package Hotel **/
    public function showUploadPHotelForm($packageId) 
    {
        $package_itenary = DB::table('package_itenary')
            ->where('packageId', $packageId)
            ->get();

        $budget_hotels = DB::table('package_hotels')
            ->where('hotelType', 1)
            ->get();

        $delux_hotels = DB::table('package_hotels')
            ->where('hotelType', 2)
            ->get();

        $packageData = DB::table('package')
            ->where('id', $packageId)
            ->first();

        $package        = New Package;
        $packageDetails = $package->find($packageId);

        return view('admin.auth.holidays.packages.new_package_hotel', ['packageId' => $packageId, 'packageTitle' => $packageDetails['packageTitle'], 'packageFakeId' => $packageDetails['packageId'], 'package_itenary' => $package_itenary, 'budget_hotels' => $budget_hotels, 'delux_hotels' => $delux_hotels, 'msg' => '', 'packageData' => $packageData]);
    }

    public function uploadPHotel(Request $request, $packageId) 
    {
        $request->validate([
            'itenary_id' => 'bail|required',
            'budget_hotels' => 'required',
            'delux_hotels' => 'required'

        ],
        [
            'budget_hotels.required' => 'The Budget Hotels is required',
            'delux_hotels.required' => 'The Delux Hotels is required'
        ]);

        $count = DB::table('package_hotel_relation')
            ->where('packageId', $packageId)
            ->count();

        if ($count > 0) {

            return redirect()->route('admin.upload_p_hotel_form', ['packageId' => $packageId])->with('msg', 'Hotel already addded');
        } 
        else {

            for ($i = 0; $i < count($request->input('itenary_id')); $i++) {

                DB::table('package_hotel_relation')
                    ->insert([
                        'packageId' => $packageId,
                        'packageItenaryId'   => $request->input('itenary_id')[$i],
                        'hotelType' => 1,
                        'hotelId' => $request->input('budget_hotels')[$i]
                    ]);

                DB::table('package_hotel_relation')
                    ->insert([
                        'packageId' => $packageId,
                        'packageItenaryId'   => $request->input('itenary_id')[$i],
                        'hotelType' => 2,
                        'hotelId' => $request->input('delux_hotels')[$i]
                    ]);
            }

            return redirect()->route('admin.upload_p_hotel_form', ['packageId' => $packageId])->with('msg', 'Hotel has been addded successfully');
        }
    }
    /** End of Package Hotel **/

    /** Start of Package Itenary **/
    public function showUploadPItenaryForm(Request $request, $packageId) {

        $package        = New Package;
        $packageDetails = $package->find($packageId);

        return view('admin.auth.holidays.packages.new_package_itenary', ['packageId' => $packageId, 'packageTitle' => $packageDetails['packageTitle'], 'packageFakeId' => $packageDetails['packageId'], 'totalDays' => $packageDetails['totalDays'], 'msg' => '']);
    }

    public function uploadPItenary(Request $request, $packageId) {

        $request->validate([
            'day'                 => 'bail|required',
            'title'               => 'required',
            'location'            => 'required',
            'itenary_banner_file' => 'required',
            'itenary_desc'        => 'required',
            'total_day'           => 'required'
        ],
        [
            'day.required'                 => 'The days is required',
            'title.required'               => 'The title is required',
            'location.required'            => 'The location is required',
            'itenary_banner_file.required' => 'The banner is required', 
            'itenary_desc.required'        => 'The description is required', 
            'total_day.required'           => 'The total day is required', 
        ]);

        $package         = New Package;
        $package_itenary = New PItenary;
        $packageItenaryCnt = $package_itenary->where('packageId', $packageId)
                                                ->count();

        if ($packageItenaryCnt > 0) 
            return redirect()->route('admin.upload_p_itenary_form', ['packageId' => $packageId])->with('msg', 'Itenary already added');
        else{

            for($i = 0; $i < $request->input('total_day'); $i++) {

                $image     = $request->file('itenary_banner_file')[$i];
                $file_name = time().$i.".jpg";

                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(550, 344);

                if(!File::exists(public_path()."/assets"))
                    File::makeDirectory(public_path()."/assets");

                if(!File::exists(public_path()."/assets/itenary_banner"))
                    File::makeDirectory(public_path()."/assets/itenary_banner");

                $image_resize->save(public_path("assets/itenary_banner/".$file_name));

                $package_itenary->insert([
                    'packageId' => $packageId,
                    'days'      => $request->input('day')[$i],
                    'title'     => ucwords(strtolower($request->input('title')[$i])),
                    'location'  => $request->input('location')[$i],
                    'desc'      => $request->itenary_desc[$i],
                    'image'     => $file_name,
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }
        }

        return redirect()->route('admin.upload_p_itenary_form', ['packageId' => $packageId])->with('msg', 'Itenary has been added successfully');
    }
    /** End of Package Itenary **/

    /** Start of Package **/
    public function allPackage() {

        return view('admin.auth.holidays.packages.all_packages');
    }

    public function allPackageData(Request $request) {

        $package      = new Package;
        $package_type = new PType;

        $columns = array( 
                            0  => 'id', 
                            1  => 'package_category',
                            2  => 'package_id',
                            3  => 'type',
                            4  => 'title',
                            5  => 'offer',
                            6  => 'duration',
                            7  => 'location',
                            8  => 'offer_applicable',
                            9 => 'action',
                        );

        $totalData = $package->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {            
            
            $package_data = DB::table('package')
                            ->join('package_type', 'package.packageType', '=', 'package_type.id')
                            ->select('package.packageCategory', 'package.id', 'package.packageId', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package_type.packageType', 'package.isApplicable', 'package.status')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            $package_data = DB::table('package')
                            ->join('package_type', 'package.packageType', '=', 'package_type.id')
                            ->select('package.packageCategory', 'package.id', 'package.packageId', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package_type.packageType', 'package.isApplicable', 'package.status')
                            ->where('package.packageId','LIKE',"%{$search}%")
                            ->orWhere('package.packageTitle', 'LIKE',"%{$search}%")
                            ->orWhere('package.price', 'LIKE',"%{$search}%")
                            ->orWhere('package.offer', 'LIKE',"%{$search}%")
                            ->orWhere('package.duration', 'LIKE',"%{$search}%")
                            ->orWhere('package.location', 'LIKE',"%{$search}%")
                            ->orWhere('package_type.packageType', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = DB::table('package')
                            ->join('package_type', 'package.packageType', '=', 'package_type.id')
                            ->select('package.packageCategory', 'package.id', 'package.packageId', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package_type.packageType', 'package.isApplicable', 'package.status')
                            ->where('package.packageId','LIKE',"%{$search}%")
                            ->orWhere('package.packageTitle', 'LIKE',"%{$search}%")
                            ->orWhere('package.price', 'LIKE',"%{$search}%")
                            ->orWhere('package.offer', 'LIKE',"%{$search}%")
                            ->orWhere('package.duration', 'LIKE',"%{$search}%")
                            ->orWhere('package.location', 'LIKE',"%{$search}%")
                            ->orWhere('package_type.packageType', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($package_data)) {

            $cnt = 1;

            foreach ($package_data as $single_data) {

                if($single_data->status == 1)
                    $val = "In-Active";
                else
                    $val = "Active";

                if($single_data->isApplicable == 1)
                    $val_1 = "Yes";
                else
                    $val_1 = "No";

                if($single_data->packageCategory == 1)
                    $category = "Domestic";
                else
                    $category = "International";

                $nestedData['id']               = "<b>".$cnt."</b>";
                $nestedData['package_category'] = "<b>".$category."</b>";
                $nestedData['package_id']       = "<b>".$single_data->packageId."</b>";
                $nestedData['type']             = "<b>".$single_data->packageType."</b>";
                $nestedData['title']            = "<b>".$single_data->packageTitle."</b>";
                $nestedData['offer']            = "<b>".$single_data->offer."</b>";
                $nestedData['duration']         = "<b>".$single_data->duration."</b>";
                $nestedData['location']         = "<b>".$single_data->location."</b>";
                $nestedData['offer_applicable'] = "<b>".$val_1;
                $nestedData['action']           = "&emsp;<p id=\"package_id$cnt\" hidden>$single_data->id</p><button type=\"button\" id=\"package_detail$cnt\" onclick=\"show_package_detail($cnt)\" class=\"btn btn-success form-text-element\">Package Details</button>&emsp;<p id=\"package_id$cnt\" hidden>$single_data->id</p><a href=\"".route('admin.edit_package_price_form', ['packageId' => $single_data->id])."\" class=\"btn btn-danger form-text-element\">Update Price</a>&emsp;<a href=\"".route('admin.p_edit_form', ['packageId' => $single_data->id])."\" class=\"btn btn-primary form-text-element\">Update Basic</a>&emsp;<a href=\"".route('admin.package_status_change', ['packageId' => $single_data->id])."\" class=\"btn btn-info form-text-element\">$val</a>&emsp;<a href=\"".route('admin.package_banner_image_change', ['packageId' => $single_data->id])."\" class=\"btn btn-warning form-text-element\">Change Banner Image</a>&emsp;<a href=\"".route('admin.package_other_section', ['packageId' => $single_data->id])."\" class=\"btn btn-danger form-text-element\">Other Sections</a>&emsp;<a href=\"".route('admin.make_popular_package', ['packageId' => $single_data->id])."\" class=\"btn btn-warning form-text-element\">Make a Popular Package</a>";

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function showPackageEditForm($packageId) 
    {
        $package     = new Package;
        $packageData = $package->find($packageId);

        $ptype     = new PType;
        $ptypeData = $ptype->all();

        $pfacility     = new PFacility;
        $pfacilityData = $pfacility->all();

        $pfrelation     = new PFRelation;
        $pfrelationData = $pfrelation->where('packageId', $packageId)->get();


        return view('admin.auth.holidays.packages.edit_pacakge', ['ptypeData' => $ptypeData, 'pfacilityData' => $pfacilityData, 'packageData' => $packageData, 'pfrelationData' => $pfrelationData]);
    }

    public function updatePackage(Request $request, $packageId) {
        $request->validate([
            'package_id'      => 'bail|required',
            'package_category'=> 'required|numeric',
            'package_type'    => 'required|numeric',
            'package_title'   => 'required',
            'package_desc'    => 'required',
            'offer'           => 'required',
            'duration'        => 'required',
            'total_days'      => 'required|numeric',
            'total_nights'    => 'required|numeric',
            'location'        => 'required',
            'longitude'       => 'required',
            'latitude'        => 'required',
            'is_applicable'   => 'required|numeric',
        ],
        [
            'package_id.required'      => 'The Package ID is required',
            'package_category.required'=> 'The Package Category is required',
            'package_type.required'    => 'The Package Type is required',
            'package_title.required'   => 'The Package Title is required',
            'package_desc.required'    => 'The Package Description is required',
            'offer.required'           => 'The offer is required',
            'duration.required'        => 'The duration is required',
            'total_days.required'      => 'The Total Days is required',
            'total_nights.required'    => 'The Total Night is required',
            'location.required'        => 'The location is required',
            'longitude.required'       => 'The longitude is required',
            'latitude.required'        => 'The latitude is required',
            'is_applicable.required'   => 'The Coupon applicable is required',
        ]);

        $package    = new Package;
        $pfrelation = new PFRelation;

        $packageUpdate = $package->where('id', $packageId)
                                ->update([
                                    'packageId'      => $request->input('package_id'),
                                    'packageType'    =>$request->input('package_type'),
                                    'packageCategory'=>$request->input('package_category'),
                                    'packageTitle'   => $request->input('package_title'),
                                    'packageDesc'    =>$request->input('package_desc'),
                                    'offer'          =>$request->input('offer'),
                                    'duration'       =>ucwords(strtolower($request->input('duration'))),
                                    'totalDays'      =>$request->input('total_days'),
                                    'totalNights'    =>$request->input('total_nights'),
                                    'location'       => ucwords(strtolower($request->input('location'))),
                                    'longitude'      => $request->input('longitude'),
                                    'latitude'       => $request->input('latitude'),
                                    'isApplicable'   => $request->input('is_applicable'),
                                ]);

        $pfrelation->where('packageId', $packageId)->delete();

        /** Start of Adding Package Facility **/
        if ($request->has('package_facility') > 0) {
                
            foreach ($request->package_facility as $value)
                $pfrelation->insert([
                    'packageId'         => $packageId,
                    'packageFacilityId' => $value,
                    'created_at'        => now(),
                    'updated_at'        => now()
                ]);
        }
        /** End of Adding Package Facility **/

        return redirect()->route('admin.p_edit_form', ['packageId' => $packageId])->with('msg', 'Record has been updated successfully');
    }

    public function changePackageStatus($packageId) {

        $package     = new Package;
        $packageData = $package->where('id', $packageId)
                                ->get();

        if ($packageData[0]['status'] == 1) {
            $package->where('id', $packageId)
                    ->update(['status' => 0]);
        } else {
            $package->where('id', $packageId)
                    ->update(['status' => 1]);
        }

        return redirect()->route('admin.all_package');
    }

    public function makePopularPackage($packageId) {

        $ppackage    = new PPackage;
        $ppackageCnt = $ppackage->count();

        if ($ppackageCnt == 3) {

            $ppackageCnt_1 = $ppackage->where('package_id', $packageId)
                                        ->count();

            if ($ppackageCnt_1 == 0) {

                $minId = $ppackage->min('id');
                $maxId = $ppackage->max('id');
                $id    = rand($minId, $maxId);
                $ppackage->where('id', $id)
                        ->update(['package_id' => $packageId]);
            }

            return redirect()->route('admin.all_package');            
        } else {

            $ppackage->package_id = $packageId;
            $ppackage->save();

            return redirect()->route('admin.all_package');
        }
    }

    public function changePackageBannerImage($packageId) {

        $package     = new Package;
        $packageData = $package->find($packageId);

        $url = route('admin.banner_image', ['filename' => $packageData->coverImage]);

        return view('admin.auth.holidays.packages.package_banner_image_change' , ['url' => $url, 'file_name' => $packageData->coverImage, 'packageId' => $packageId]);
    } 

    public function updateBannerImage(Request $request, $file_name, $packageId) {

        $request->validate([
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ],
        [
            'icon.required' => 'The banner is required',
        ]);

        if($request->hasFile('icon')) {

            $image = $request->file('icon');

            unlink(public_path("assets/package_banner/thumnail_1/".$file_name));
            unlink(public_path("assets/package_banner/thumnail_2/".$file_name));

            $imageResize = Image::make($image->getRealPath());              
            $imageResize->resize(700, 400);

            if(!File::exists(public_path()."/assets"))
                File::makeDirectory(public_path()."/assets");

            if(!File::exists(public_path()."/assets/package_banner"))
                File::makeDirectory(public_path()."/assets/package_banner");

            if(!File::exists(public_path()."/assets/package_banner/thumnail_1"))
                File::makeDirectory(public_path()."/assets/package_banner/thumnail_1");

            $imageResize->save(public_path("assets/package_banner/thumnail_1/".$file_name));

            $imageResize = Image::make($image->getRealPath());              
            $imageResize->resize(350, 300);

            if(!File::exists(public_path()."/assets"))
                File::makeDirectory(public_path()."/assets");

            if(!File::exists(public_path()."/assets/package_banner"))
                File::makeDirectory(public_path()."/assets/package_banner");

            if(!File::exists(public_path()."/assets/package_banner/thumnail_2"))
                File::makeDirectory(public_path()."/assets/package_banner/thumnail_2");

            $imageResize->save(public_path("assets/package_banner/thumnail_2/".$file_name));

            return redirect()->route('admin.package_banner_image_change', ['packageId' => $packageId])->with('msg', 'Banner has been changed successfully.');
        } else
            return redirect()->route('admin.package_banner_image_change', ['packageId' => $packageId])->with('msg', 'Something wrong while changing.');
    }

    public function packageOtherSection($packageId) {

        $package      = new Package;
        $packageData  = $package->find($packageId);

        return view('admin.auth.holidays.packages.package_other_section', ['packageId' => $packageData->id, 'packageTitle' => $packageData->packageTitle, 'packageFakeId' => $packageData->packageId]);
    }

    public function bannerImage ($filename) {

        $path = public_path('assets/package_banner/thumnail_2/'.$filename);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function changePackageSliderImage($packageId) {

        $package     = new Package;
        $packageData = $package->find($packageId);

        $package_images      = new PImages;
        $package_images_data = $package_images->where('packageId', $packageId)
                                                ->get();

        return view('admin.auth.holidays.packages.package_all_slider_images' , ['packageData' => $packageData, 'packageImagesData' => $package_images_data]);
    }

    public function updateSliderImage(Request $request, $file_name, $packageId) {

        $request->validate([
            'package_slider_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ],
        [
            'package_slider_file.required' => 'The slider is required',
        ]);

        if($request->hasFile('package_slider_file')) {

            $image = $request->file('package_slider_file');

            unlink(public_path("assets/package_slider/".$file_name));

            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(850, 450);

            if(!File::exists(public_path()."/assets"))
                File::makeDirectory(public_path()."/assets");

            if(!File::exists(public_path()."/assets/package_slider"))
                File::makeDirectory(public_path()."/assets/package_slider");

            $image_resize->save(public_path("assets/package_slider/".$file_name));

            return redirect()->route('admin.package_slider_image_change', ['packageId' => $packageId]);
        } else
            return redirect()->route('admin.package_slider_image_change', ['packageId' => $packageId]);
    }

    public function sliderImage ($filename) {

        $path = public_path('assets/package_slider/'.$filename);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function editPackagePriceForm($packageId) {
        
        $package_price = DB::table('package_price')
            ->where('packageId', $packageId)
            ->get();
            
        return view('admin.auth.holidays.packages.edit_package_price', ['package_price' => $package_price, 'packageId' => $packageId]);
    }

    public function updatePackagePrice(Request $request, $packageId) {
        
        $request->validate([
            'price_id'     => 'bail|required',
            'total_persons'=> 'required',
            'amount'       => 'required',
        ],
        [
            'total_persons.required' => 'The total persons is required',
            'amount.required'        => 'The amount is required', 
        ]);

        $package_price_cnt = DB::table('package_price')
            ->where('packageId', $packageId)
            ->count();

        if ($package_price_cnt > 0) {
            for($i=0; $i<count($request->input('total_persons')); $i++){
                if(!empty($request->input('price_id')[$i])){
                    DB::table('package_price')
                        ->where('id', $request->input('price_id')[$i])
                        ->update([
                            'totalPersons' => $request->input('total_persons')[$i],
                            'amount' => $request->input('amount')[$i]
                        ]);
                } else {
                    DB::table('package_price')
                        ->insert([
                            'packageId' => $packageId,
                            'totalPersons' => $request->input('total_persons')[$i],
                            'amount' => $request->input('amount')[$i]
                        ]);
                }
            }
        }
        else {
            for($i=0; $i<count($request->input('total_persons')); $i++){
                DB::table('package_price')
                    ->insert([
                        'packageId' => $packageId,
                        'totalPersons' => $request->input('total_persons')[$i],
                        'amount' => $request->input('amount')[$i]
                    ]);
            }
        }

        return redirect()->route('admin.edit_package_price_form', ['packageId' => $packageId])->with('msg', 'Price has been updated successfully');
    }

    public function deletePackagePrice($price_id, $packageId) {
        DB::table('package_price')
            ->where('id', $price_id)
            ->delete();

        return redirect()->route('admin.edit_package_price_form', ['packageId' => $packageId])->with('msg', 'Price has been deleted successfully');
    }

    public function editPackageFacilityForm($packageId) {

        $package     = New Package;
        $packageData = $package->find($packageId);

        return view('admin.auth.holidays.packages.edit_package_facility', ['packageData' => $packageData]);
    }

    public function updatePackageFacility(Request $request, $packageId) {

        $request->validate([
            'package_include_facility'  => 'bail|required',
            'package_excluded_facility' => 'required',
            'terms_and_condition'       => 'required',
        ],
        [
            'package_include_facility.required'  => 'The package included facility is required',
            'package_excluded_facility.required' => 'The Package excluded facility is required',
            'terms_and_condition.required'       => 'The terms and condition is required', 
        ]);

        $package        = New Package;
        $packageUpdate  =  $package->where('id', $packageId)
                                    ->update(['includeFacility' => $request->input('package_include_facility'), 'excludeFacility' => $request->input('package_excluded_facility'), 'termCondition' => $request->input('terms_and_condition')]);
        $packageDetails = $package->find($packageId);

        if ($packageUpdate)
            return redirect()->route('admin.edit_package_facility_form', ['packageId' => $packageId])->with('msg', 'Facility has been updated successfully');
        else
            return redirect()->route('admin.edit_package_facility_form', ['packageId' => $packageId])->with('msg', 'Something wrong while updating');
    }

    public function editPackageHotelForm($packageId) {
    
        $package_itenary = DB::table('package_itenary')
            ->where('packageId', $packageId)
            ->get();

        $package_hotels = [];
        for ($i = 0; $i < count($package_itenary); $i++) {
            
            $package_budget_hotels = DB::table('package_hotel_relation')
                ->where('packageId', $packageId)
                ->where('packageItenaryId', $package_itenary[$i]->id)
                ->where('hotelType', 1)
                ->first();

            $package_delux_hotels = DB::table('package_hotel_relation')
                ->where('packageId', $packageId)
                ->where('packageItenaryId', $package_itenary[$i]->id)
                ->where('hotelType', 2)
                ->first();

            if(!empty($package_budget_hotels)) {
                $package_hotels[] = [
                    'hotelBudgetId' => $package_budget_hotels->hotelId,
                    'hotelDeluxId' => $package_delux_hotels->hotelId,
                ];
            }
        }

        $packageData = DB::table('package')
            ->where('id', $packageId)
            ->first();

        $budget_hotels = DB::table('package_hotels')
            ->where('hotelType', 1)
            ->get();

        $delux_hotels = DB::table('package_hotels')
            ->where('hotelType', 2)
            ->get();

        return view('admin.auth.holidays.packages.edit_package_hotel', ['package_hotels' => $package_hotels, 'package_itenary' => $package_itenary, 'packageData' => $packageData, 'budget_hotels' => $budget_hotels, 'delux_hotels' => $delux_hotels]);
    }

    public function updatePackageHotels(Request $request, $packageId) 
    {  
        $request->validate([
            'itenary_id' => 'required',
            'budget_hotels' => 'required',
            'delux_hotels' => 'required'
        ]);

        for ($i=0; $i < count($request->input('itenary_id')); $i++) { 
            
            $check_budget_hotel = DB::table('package_hotel_relation')
                ->where('packageId', $packageId)
                ->where('packageItenaryId', $request->input('itenary_id')[$i])
                ->where('hotelType', 1)
                ->count();

            $check_delux_hotel = DB::table('package_hotel_relation')
                ->where('packageId', $packageId)
                ->where('packageItenaryId', $request->input('itenary_id')[$i])
                ->where('hotelType', 2)
                ->count();

            if ($check_budget_hotel > 0) {
                
                DB::table('package_hotel_relation')
                    ->where('packageId', $packageId)
                    ->where('packageItenaryId', $request->input('itenary_id')[$i])
                    ->where('hotelType', 1)
                    ->update([
                        'hotelId' => $request->input('budget_hotels')[$i]
                    ]);
            } else {

                DB::table('package_hotel_relation')
                    ->insert([
                        'packageId' => $packageId,
                        'packageItenaryId' => $request->input('itenary_id')[$i],
                        'hotelType' => 1,
                        'hotelId' => $request->input('budget_hotels')[$i]
                    ]);
            }

            if ($check_delux_hotel > 0) {
                
                DB::table('package_hotel_relation')
                    ->where('packageId', $packageId)
                    ->where('packageItenaryId', $request->input('itenary_id')[$i])
                    ->where('hotelType', 2)
                    ->update([
                        'hotelId' => $request->input('delux_hotels')[$i]
                    ]);
            } else {

                DB::table('package_hotel_relation')
                    ->insert([
                        'packageId' => $packageId,
                        'packageItenaryId' => $request->input('itenary_id')[$i],
                        'hotelType' => 2,
                        'hotelId' => $request->input('delux_hotels')[$i]
                    ]);
            }
        }

        return redirect()->route('admin.edit_package_hotel_form', ['packageId' => $packageId])->with('msg', 'Hotel has been updated successfully');
    }

    public function editPackageItenaryForm ($packageId) {

        $package            = New Package;
        $packageData        = $package->find($packageId);
        $packageItenary     = new PItenary;
        $packageItenaryData = $packageItenary->where('packageId', $packageId)
                                            ->get();

        if (empty($packageItenaryData))
            $packageItenaryData = "";

        return view('admin.auth.holidays.packages.edit_package_itenary', ['packageData' => $packageData, 'packageItenaryData' => $packageItenaryData]);
    }

    public function itenaryImage ($filename) {

        $path = public_path('assets/itenary_banner/'.$filename);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function updatePackageItenarys(Request $request, $packageId) {
        
        $request->validate([
            'title'           => 'bail|required',
            'itenary_desc'    => 'required',
            'location'        => 'required',
            'old_itenary_img' => 'required',
            'itenary_id'      => 'required'
        ],
        [
            'title.required'        => 'The title is required',
            'itenary_desc.required' => 'The description is required', 
        ]);

        $package           = New Package;
        $package_itenary   = New PItenary;
        $packageItenaryCnt = $package_itenary->where('packageId', $packageId)
                                                ->count();

        $packageData = $package->find($packageId);
        if ($packageItenaryCnt > 0) {

            for($i = 0; $i < $packageData->totalDays; $i++) {
                if(!empty($request->input('itenary_id')[$i])){
                    if ($request->hasFile('itenary_banner_file')) {
                    
                        if (isset($request->file('itenary_banner_file')[$i])) {
                            
                            $image     = $request->file('itenary_banner_file')[$i];
                            $file_name = $request->input('old_itenary_img')[$i];
    
                            unlink(public_path("assets/itenary_banner/".$file_name));
    
                            $image_resize = Image::make($image->getRealPath());              
                            $image_resize->resize(550, 344);
    
                            if(!File::exists(public_path()."/assets"))
                                File::makeDirectory(public_path()."/assets");
    
                            if(!File::exists(public_path()."/assets/itenary_banner"))
                                File::makeDirectory(public_path()."/assets/itenary_banner");
    
                            $image_resize->save(public_path("assets/itenary_banner/".$file_name));
    
                            $package_itenary->where('id', $request->input('itenary_id')[$i])
                                        ->where('packageId', $packageId)
                                        ->update([
                                            'title'     => ucwords(strtolower($request->input('title')[$i])),
                                            'location'  => $request->location[$i],
                                            'desc'      => $request->itenary_desc[$i],
                                            'updated_at'=> now(),
                                        ]);
                        } 
                    } else {
    
                        $package_itenary->where('id', $request->input('itenary_id')[$i])
                                        ->where('packageId', $packageId)
                                        ->update([
                                            'title'     => ucwords(strtolower($request->input('title')[$i])),
                                            'location'  => $request->location[$i],
                                            'desc'      => $request->itenary_desc[$i],
                                            'updated_at'=> now(),
                                        ]);
                    }
                } else {
                    $image     = $request->file('itenary_banner_file')[$i];
                    $file_name = time().$i.".jpg";

                    $image_resize = Image::make($image->getRealPath());              
                    $image_resize->resize(550, 344);

                    if(!File::exists(public_path()."/assets"))
                        File::makeDirectory(public_path()."/assets");

                    if(!File::exists(public_path()."/assets/itenary_banner"))
                        File::makeDirectory(public_path()."/assets/itenary_banner");

                    $image_resize->save(public_path("assets/itenary_banner/".$file_name));

                    $package_itenary->insert([
                        'packageId' => $packageId,
                        'days'      => $request->input('day')[$i],
                        'title'     => ucwords(strtolower($request->input('title')[$i])),
                        'location'  => $request->location[$i],
                        'desc'      => $request->itenary_desc[$i],
                        'image'     => $file_name,
                        'created_at'=> now(),
                        'updated_at'=> now(),
                    ]);
                }
            }
        }
        else {
            for($i = 0; $i < $packageData->totalDays; $i++) {

                $image     = $request->file('itenary_banner_file')[$i];
                $file_name = time().$i.".jpg";

                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(550, 344);

                if(!File::exists(public_path()."/assets"))
                    File::makeDirectory(public_path()."/assets");

                if(!File::exists(public_path()."/assets/itenary_banner"))
                    File::makeDirectory(public_path()."/assets/itenary_banner");

                $image_resize->save(public_path("assets/itenary_banner/".$file_name));

                $package_itenary->insert([
                    'packageId' => $packageId,
                    'days'      => $request->input('day')[$i],
                    'title'     => ucwords(strtolower($request->input('title')[$i])),
                    'location'  => $request->location[$i],
                    'desc'      => $request->itenary_desc[$i],
                    'image'     => $file_name,
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);
            }

            return redirect()->route('admin.edit_package_itenary_form', ['packageId' => $packageId])->with('msg', 'Itenary has been updated successfully');
        }

        return redirect()->route('admin.edit_package_itenary_form', ['packageId' => $packageId])->with('msg', 'Itenary has been updated successfully');
    }
    /** End of Package **/

    //End of Package

    /** Pacakge Booking **/
    public function packageBooking ($status) {

        if ($status == 1)
            return view('admin.auth.holidays.booking.new_package_booking');
        if ($status == 2)
            return view('admin.auth.holidays.booking.confirm_package_booking');
        if ($status == 3)
            return view('admin.auth.holidays.booking.cancel_package_booking');
        if ($status == 4)
            return view('admin.auth.holidays.booking.complete_package_booking');
    }

    public function allPackageBooking () {
        return view('admin.auth.holidays.booking.all_package_booking');
    }

    public function packageBookingData(Request $request) {

        $packageBooking = new PBBDetails;

        $columns = array( 
                            0 => 'id', 
                            1 => 'transactionNo',
                            2 => 'userName',
                            3 => 'userEmail',
                            4 => 'journeyDate',
                            5 => 'pacakgeTitle',
                            6 => 'duration',
                            7 => 'location',
                            8=> 'price',
                            9=> 'action'
                        );

        $totalData = $packageBooking
                                ->where('status', $request->input('status'))
                                ->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {            
            
            $booking_data = DB::table('package_booking_basic_details')
                            ->where('package_booking_basic_details.status', $request->input('status'))
                            ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                            ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                            ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.packageTitle', 'package.duration', 'package.location')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('package_booking_basic_details.'.$order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            $booking_data = DB::table('package_booking_basic_details')
                            ->where('package_booking_basic_details.status', $request->input('status'))
                            ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                            ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                            ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.packageTitle', 'package.duration', 'package.location')
                            ->where('package_booking_basic_details.txtNo', 'LIKE',"%{$search}%")
                            ->orWhere('package_booking_basic_details.startDate', 'LIKE',"%{$search}%")
                            ->orWhere('users.name', 'LIKE',"%{$search}%")
                            ->orWhere('users.email', 'LIKE',"%{$search}%")
                            ->orWhere('package.packageTitle', 'LIKE',"%{$search}%")
                            ->orWhere('package.duration', 'LIKE',"%{$search}%")
                            ->orWhere('package.location', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('package_booking_basic_details.'.$order,$dir)
                            ->get();    

            $totalFiltered = DB::table('package_booking_basic_details')
                            ->where('package_booking_basic_details.status', $request->input('status'))
                            ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                            ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                            ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.packageTitle', 'package.duration', 'package.location')
                            ->where('package_booking_basic_details.txtNo', 'LIKE',"%{$search}%")
                            ->orWhere('package_booking_basic_details.startDate', 'LIKE',"%{$search}%")
                            ->orWhere('users.name', 'LIKE',"%{$search}%")
                            ->orWhere('users.email', 'LIKE',"%{$search}%")
                            ->orWhere('package.packageTitle', 'LIKE',"%{$search}%")
                            ->orWhere('package.duration', 'LIKE',"%{$search}%")
                            ->orWhere('package.location', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($booking_data)) {

            $cnt = 1;

            foreach ($booking_data as $single_data) {

                $action = "";

                if($request->input('status') == 1){

                    $action = "<a class=\"btn btn-primary form-text-element\" href=\"".route('admin.p_booking_invoice', ['bookingId' => $single_data->id])."\" target=\"_blank\">View Booking</a>&nbsp;&nbsp;<a href=\"".route('admin.p_booking_status', ['bookingId' => $single_data->id, 'status' => 2])."\" class=\"btn btn-success form-text-element\">Confirm Booking</a>&nbsp;&nbsp;<a href=\"".route('admin.p_booking_status', ['bookingId' => $single_data->id, 'status' => 3])."\" class=\"btn btn-danger form-text-element\">Cancel Booking</a>";
                }
                else if($request->input('status') == 2){

                    $action = "<a class=\"btn btn-primary form-text-element\" href=\"".route('admin.p_booking_invoice', ['bookingId' => $single_data->id])."\" target=\"_blank\">View Booking</a>&nbsp;&nbsp;<a href=\"".route('admin.p_booking_status', ['bookingId' => $single_data->id, 'status' => 4])."\" class=\"btn btn-success form-text-element\">Complete Booking</a>&nbsp;&nbsp;<a href=\"".route('admin.p_booking_payment', ['bookingId' => $single_data->id, 'status' => 2])."\" class=\"btn btn-warning form-text-element\">Payment Done</a>&nbsp;&nbsp;<a href=\"".route('admin.p_booking_status', ['bookingId' => $single_data->id, 'status' => 3])."\" class=\"btn btn-danger form-text-element\">Cancel Booking</a>";
                }
                else if($request->input('status') == 3){

                    $action = "<a class=\"btn btn-primary form-text-element\" href=\"".route('admin.p_booking_invoice', ['bookingId' => $single_data->id])."\" target=\"_blank\">View Booking</a>";
                }
                else if($request->input('status') == 4){

                    $action = "<a class=\"btn btn-primary form-text-element\" href=\"".route('admin.p_booking_invoice', ['bookingId' => $single_data->id])."\" target=\"_blank\">View Booking</a>&nbsp;&nbsp;<a href=\"".route('admin.p_booking_payment', ['bookingId' => $single_data->id, 'status' => 4])."\" class=\"btn btn-warning form-text-element\">Payment Done</a>";
                }
                else if($request->input('status') == 5){

                    $action = "<a class=\"btn btn-primary form-text-element\" href=\"".route('admin.p_booking_invoice', ['bookingId' => $single_data->id])."\" target=\"_blank\">View Booking</a>";
                }
                // else if($single_data->bookingStatus == 2){

                //     $action = "<a href=\"".url('/admin/cancel_boat_booking_status', ['bookingId' => $single_data->pid, 'bookingStatus' => 3])."\" class=\"btn btn-danger\">Cancel Booking</a>";
                // }
                // else {

                //     $action = "Booking has been cancelled";
                // }

                $nestedData['id']            = "<b>".$cnt."<b>";
                $nestedData['transactionNo'] = "<b>".$single_data->txtNo."<b>";
                $nestedData['userName']      = "<b>".$single_data->name."<b>";
                $nestedData['userEmail']     = "<b>".$single_data->email."<b>";
                $nestedData['journeyDate']   = "<b>".$single_data->startDate."<b>";
                $nestedData['pacakgeTitle']  = "<p id=\"package_id$cnt\" hidden>$single_data->packageId</p><a onclick=\"show_package_detail($cnt)\" title=\"Click Me View Details\"><b>".$single_data->packageTitle."<b></a>";
                $nestedData['duration']      = "<b>".$single_data->duration."<b>";
                $nestedData['location']      = "<b>".$single_data->location."<b>";
                $nestedData['price']         = "<b>".$single_data->payableAmount."<b>";
                $nestedData['action']        = "<b>".$action."<b>";

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function allPackageBookingData (Request $request) {

        $packageBooking = new PBBDetails;

        $columns = array( 
                            0 => 'id', 
                            1 => 'transactionNo',
                            2 => 'userName',
                            3 => 'userEmail',
                            4 => 'journeyDate',
                            5 => 'pacakgeTitle',
                            6 => 'duration',
                            7 => 'location',
                            8 => 'price',
                            9 => 'action'
                        );

        $totalData = $packageBooking->count();

        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {            
            
            $booking_data = DB::table('package_booking_basic_details')
                            ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                            ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                            ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.packageTitle', 'package.duration', 'package.location')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('package_booking_basic_details.'.$order,$dir)
                            ->get();
        }
        else {

            $search = $request->input('search.value'); 

            $booking_data = DB::table('package_booking_basic_details')
                            ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                            ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                            ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.packageTitle', 'package.duration', 'package.location')
                            ->where('package_booking_basic_details.txtNo', 'LIKE',"%{$search}%")
                            ->orWhere('package_booking_basic_details.startDate', 'LIKE',"%{$search}%")
                            ->orWhere('users.name', 'LIKE',"%{$search}%")
                            ->orWhere('users.email', 'LIKE',"%{$search}%")
                            ->orWhere('package.packageTitle', 'LIKE',"%{$search}%")
                            ->orWhere('package.duration', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy('package_booking_basic_details.'.$order,$dir)
                            ->get();    

            $totalFiltered = DB::table('package_booking_basic_details')
                            ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                            ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                            ->join('package_hotels', 'package_booking_basic_details.hotelId', '=', 'package_hotels.id')
                            ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.packageTitle', 'package.duration', 'package.location')
                            ->where('package_booking_basic_details.txtNo', 'LIKE',"%{$search}%")
                            ->orWhere('package_booking_basic_details.startDate', 'LIKE',"%{$search}%")
                            ->orWhere('users.name', 'LIKE',"%{$search}%")
                            ->orWhere('users.email', 'LIKE',"%{$search}%")
                            ->orWhere('package.packageTitle', 'LIKE',"%{$search}%")
                            ->orWhere('package.duration', 'LIKE',"%{$search}%")
                            ->orWhere('package.location', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();

        if(!empty($booking_data)) {

            $cnt = 1;

            foreach ($booking_data as $single_data) {

                $action = "<a class=\"btn btn-primary form-text-element\" href=\"".route('admin.p_booking_invoice', ['bookingId' => $single_data->id])."\" target=\"_blank\">View Booking</a>";

                $nestedData['id']            = "<b>".$cnt."<b>";
                $nestedData['transactionNo'] = "<b>".$single_data->txtNo."<b>";
                $nestedData['userName']      = "<b>".$single_data->name."<b>";
                $nestedData['userEmail']     = "<b>".$single_data->email."<b>";
                $nestedData['journeyDate']   = "<b>".$single_data->startDate."<b>";
                $nestedData['pacakgeTitle']  = "<p id=\"package_id$cnt\" hidden>$single_data->packageId</p><a onclick=\"show_package_detail($cnt)\" title=\"Click Me View Details\"><b>".$single_data->packageTitle."<b></a>";
                $nestedData['duration']      = "<b>".$single_data->duration."<b>";
                $nestedData['location']      = "<b>".$single_data->location."<b>";
                $nestedData['action']        = "<b>".$action."<b>";

                $data[] = $nestedData;

                $cnt++;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                    );
            
        print json_encode($json_data); 
    }

    public function pacakgeBookingStatus ($bookingId, $status) {
        $pbbdetails       = new PBBDetails;
        $pbbdetails->where('id', $bookingId)
                    ->update([
                        'status' => $status
                    ]);

        return redirect()->route('admin.p_booking', ['status' => $status]);
    }

    public function pacakgeBookingInvoice ($bookingId) {
        $pbbdetails     = new PBBDetails;
        $pbtdetails     = new PBTDetails;
        $pbbdetailsData = $pbbdetails->where('package_booking_basic_details.id', $bookingId)
                                    ->join('users', 'package_booking_basic_details.userId', '=', 'users.id')
                                    ->join('package', 'package_booking_basic_details.packageId', '=', 'package.id')
                                    ->leftJoin('package_coupon', 'package_booking_basic_details.couponId', '=', 'package_coupon.id')
                                    ->select('package_booking_basic_details.*', 'users.name', 'users.email', 'package.id as p_id', 'package.packageId', 'package.packageTitle', 'package.offer', 'package.duration', 'package.location', 'package_coupon.flatAmount')
                                    ->get();

        $pbtdetailsData = $pbtdetails->where('pbbdId', $bookingId)
                                        ->get();

        $packagePrice = DB::table('package_price')
                ->where('packageId', $pbbdetailsData[0]->p_id)
                ->where('totalPersons', $pbbdetailsData[0]->totalPersons)
                ->get();

        $package_hotels = DB::table('package_hotel_booking')
            ->leftJoin('package_hotels', 'package_hotel_booking.hotelId', '=', 'package_hotels.id')
            ->where('package_hotel_booking.bookingId', $bookingId)
            ->select('package_hotels.*')
            ->get();

        return view('admin.auth.holidays.booking.package_booking_invoice', ['pbbdetailsData' => $pbbdetailsData, 'pbtdetailsData' => $pbtdetailsData, 'packagePrice' => $packagePrice, 'package_hotels' => $package_hotels]);
    }

    public function packageBookingPayment ($bookingId, $status) {

        $booking_detail = DB::table('package_booking_basic_details')
            ->where('id', $bookingId)
            ->first();

        DB::table('package_booking_basic_details')
            ->where('id', $bookingId)
            ->update([
                'paid_amount' => $booking_detail->payableAmount,
                'remaining_amount' => 0,
                'paymentStatus' => 1
            ]);

        return redirect()->route('admin.p_booking', ['status' => $status]);
    }
    /** End of Pacakge Booking **/
}
