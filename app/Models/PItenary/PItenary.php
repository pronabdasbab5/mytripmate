<?php

namespace App\Models\PItenary;

use Illuminate\Database\Eloquent\Model;

class PItenary extends Model
{
    protected $table = 'package_itenary';

    protected $fillable = ['packageId', 'days', 'title', 'location', 'desc', 'image'];
}
