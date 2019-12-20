<?php

namespace App\Models\PType;

use Illuminate\Database\Eloquent\Model;

class PType extends Model
{
    protected $table = 'package_type';

    protected $fillable = ['packageType'];
}
