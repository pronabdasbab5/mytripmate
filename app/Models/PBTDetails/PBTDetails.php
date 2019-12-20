<?php

namespace App\Models\PBTDetails;

use Illuminate\Database\Eloquent\Model;

class PBTDetails extends Model
{
    protected $table = 'package_booking_traveller_details';

    protected $fillable = ['pbbdId', 'txtNo', 't_name', 't_con_no', 't_email', 't_age', 'gender'];

    public function traveller_basic_traveller() {

    	return $this->belongsTo('App\Models\PBBDetails\PBBDetails', 'pbbdId', 'id');
    }
}
