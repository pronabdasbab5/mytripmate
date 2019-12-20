<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $fillable = ['packageCategory', 'packageId', 'packageType', 'packageTitle', 'packageDesc', 'price', 'offer', 'journeyDate', 'duration', 'totalDays', 'totalNights', 'location', 'googleLocation', 'rating', 'coverImage', 'includeFacility', 'excludeFacility', 'termCondition', 'isApplicable', 'status'];
}
