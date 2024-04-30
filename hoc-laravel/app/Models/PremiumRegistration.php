<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PDO;

class PremiumRegistration extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'premium_registration';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected $primaryKey = 'registration_id';

    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
    ];

    //kiểm tra user có đang sử dụng gói premium còn hạn hay không
    public static function isUserPremiumActive(int $userId): bool
    {
        $currentDate = date('Y-m-d H:i:s');
        return self::query()
            ->where('user_id', $userId)
            ->where('end_date', '>', $currentDate)
            ->exists();
    }

    //lấy tất cả các gói premium đã hết hạn của user
    public static function getExpiredPremiumRegistrationsByUser(int $userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('user_id', $userId)
            ->where('end_date', '<', $currentDate)
            ->get();

        return $result;
    }

    //lấy gói premium đang sử dụng của user
    public static function getCurrentPremiumRegistrationByUser(int $userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('user_id', $userId)
            ->where('end_date', '>', $currentDate)
            ->first();

        return $result;


//        "SELECT * FROM premium_registration WHERE user_id = :userId AND end_date > :currentDate LIMIT 1";

    }

    //lấy tất cả các gói premium của user
    public static function getAllPremiumRegistrationsByUser(int $userId)
    {
        return self::query()
            ->where('user_id', $userId)
            ->get();
    }

    //lấy những user được share gói premium theo id của premium registration
    public function sharedUsers()
    {
        return $this->hasMany(SharePremium::class, 'premium_registration_id', 'registration_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(PremiumPackage::class, 'package_id');
    }
}
