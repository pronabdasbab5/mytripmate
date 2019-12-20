<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use DB;

class Indexcomposer
{
    public function indexcomposer(View $view)
    {
        $newPackageBookingData = DB::table('package_booking_basic_details')
                				    ->where('status', 1)
                                    ->count();

        $view->with('newBookingData', ['newPackageBookingData' => $newPackageBookingData]);
    }
}
?>