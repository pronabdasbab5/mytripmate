<?php

namespace App\Models\PImages;

use Illuminate\Database\Eloquent\Model;

class PImages extends Model
{
    protected $table = 'package_images';

    protected $fillable = ['packageId', 'image'];
}
