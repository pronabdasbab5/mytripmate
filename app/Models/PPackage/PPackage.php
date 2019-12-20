<?php

namespace App\Models\PPackage;

use Illuminate\Database\Eloquent\Model;

class PPackage extends Model
{
    protected $table = 'popular_package';

    protected $fillable = ['package_id'];
}
