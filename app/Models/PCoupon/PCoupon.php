<?php

namespace App\Models\PCoupon;

use Illuminate\Database\Eloquent\Model;

class PCoupon extends Model
{
    protected $table = 'package_coupon';

    protected $fillable = ['couponNumber', 'flatAmount', 'status'];
}
