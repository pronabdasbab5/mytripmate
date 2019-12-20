<?php

namespace App\Models\PFRelation;

use Illuminate\Database\Eloquent\Model;

class PFRelation extends Model
{
    protected $table = 'package_facility_raletion';

    protected $fillable = ['packageId', 'packageFacilityId', 'status'];
}
