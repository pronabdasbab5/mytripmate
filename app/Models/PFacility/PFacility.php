<?php

namespace App\Models\PFacility;

use Illuminate\Database\Eloquent\Model;

class PFacility extends Model
{
    protected $table = 'package_facility';

    protected $fillable = ['facility', 'images'];
}
