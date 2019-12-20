<?php

namespace App\Models\PBBDetails;

use Illuminate\Database\Eloquent\Model;

class PBBDetails extends Model
{
    protected $table = 'package_booking_basic_details';

    protected $fillable = ['userId', 'txtNo', 'startDate', 'packageId', 'hotelId', 'totalPersons', 'payableAmount', 'couponId', 'paymentType', 'status', 'paymentStatus'];

    public function traveller_details() {

    	return $this->hasMany('App\Models\PBTDetails\PBTDetails', 'pbbdId', 'id');
    }
}
