<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package\Package;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
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

            $ddata[] = [
                'packageId'    => $value['id'],
                'packageTitle' => $value['packageTitle'],
                'url'          => $url,
                'duration'     => $value['totalDays']."D/".$value['totalNights']."N",
            ];
        }

        foreach ($packageInternationalData as $key => $value) {
            
            $url = route('package_banner_image', ['file_name' => $value['coverImage']]);

            $idata[] = [
                'packageId'    => $value['id'],
                'packageTitle' => $value['packageTitle'],
                'url'          => $url,
                'duration'     => $value['totalDays']."D/".$value['totalNights']."N",
            ];
        }               
        
        return view('home', ['domesticPackage' => $ddata, 'internationalPackage' => $idata]);
    }
}
