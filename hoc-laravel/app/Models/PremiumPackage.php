<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumPackage extends Model{

    use HasFactory;

    public $timestamps = false;

    protected $table = 'premium_package';

    protected $primaryKey = 'package_id';

    protected $fillable = [
        'package_name',
        'price',
        'duration',
        'description',
        'share_limit',
    ];

    public static function getAllPackages(){
        return self::query()->get();
    }

    public static function getPackageById($id){
        return self::query()->where('package_id', $id)->first();
    }

    public function createPackage($data){
        return $this->create($data);
    }

    public function updatePackage($id, $data){
        return $this->where('package_id', $id)->update($data);
    }

    public function deletePackage($id){
        return $this->where('package_id', $id)->delete();
    }
}
