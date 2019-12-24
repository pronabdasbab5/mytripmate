<?php

namespace App\Models\PHotels;

use Illuminate\Database\Eloquent\Model;

class PHRelation extends Model
{
    protected $table = 'package_hotel_relation';

    protected $fillable = ['packageId', 'hotelType', 'hotelId'];
}
