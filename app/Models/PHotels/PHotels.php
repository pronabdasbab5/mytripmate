<?php

namespace App\Models\PHotels;

use Illuminate\Database\Eloquent\Model;

class PHotels extends Model
{
    protected $table = 'package_hotels';

    protected $fillable = ['hotelType', 'hotelName', 'hotelAddress', 'price', 'rating', 'status'];
}
