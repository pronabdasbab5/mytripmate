<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package\Package;
use DB;
use File;
use Response;

class IndexController extends Controller
{
    public function index() {

    	$package             = new Package;
    	$packageDomesticData = $package->where('packageCategory', 1)
			    						->orderBy(DB::raw('RAND()'))
			        					->take(6)
			        					->get();

		$packageInternationalData = $package->where('packageCategory', 2)
				    						->orderBy(DB::raw('RAND()'))
				        					->take(6)
				        					->get();

        foreach ($packageDomesticData as $key => $value) {
        	
        	$url = route('package_banner_image', ['file_name' => $value['coverImage']]);
        	
        	$package_price = DB::table('package_price')
                ->where('packageId', $value['id'])
                ->orderBy('totalPersons', 'DESC')
                ->first();

        	$ddata[] = [
                'packageId'    => $value['id'],
        		'packageTitle' => $value['packageTitle'],
        		'price'        => isset($package_price->amount)? $package_price->amount: '',
        		'url'          => $url,
        		'duration'     => $value['totalDays']."D/".$value['totalNights']."N",
        	];
        }

        foreach ($packageInternationalData as $key => $value) {
        	
        	$url = route('package_banner_image', ['file_name' => $value['coverImage']]);
        	
        	$package_price = DB::table('package_price')
                ->where('packageId', $value['id'])
                ->orderBy('totalPersons', 'DESC')
                ->first();

        	$idata[] = [
                'packageId'    => $value['id'],
        		'packageTitle' => $value['packageTitle'],
        		'price'        => isset($package_price->amount)? $package_price->amount: '',
        		'url'          => $url,
        		'duration'     => $value['totalDays']."D/".$value['totalNights']."N",
        	];
        }				
    	
    	return view('home', ['domesticPackage' => $ddata, 'internationalPackage' => $idata]);
    }

    public function packageBannerImage ($file_name) {

        $path = public_path('assets/package_banner/thumnail_1/'.$file_name);

        if (!File::exists($path)) 
            $response = 404;

        $file     = File::get($path);
        $type     = File::extension($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
