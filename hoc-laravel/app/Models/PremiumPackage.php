<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumPackage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'premium_package';

    protected $primaryKey = 'package_id';
}
