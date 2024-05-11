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


    //kiểm tra gói đăng ký premium có còn hạn không dựa vào id của gói đăng ký
    public static function isPremiumExpired(int $registrationId): bool
    {
        $currentDate = date('Y-m-d H:i:s');
        return self::query()
            ->where('registration_id', $registrationId)
            ->where('end_date', '<', $currentDate)
            ->exists();
    }

    //lấy số user đang sử dụng gói premium kể cả chủ sở hữu dựa vào id của gói đăng ký
    public function getCurrentUsersCount(): int
    {
        // Đếm bên share
        $sharedUsersCount = SharePremium::where('premium_registration_id', $this->registration_id)
            ->where('expiry_date', '>', date('Y-m-d H:i:s'))
            ->count();

        // Cộng 1 cho chủ sở hữu
        return $sharedUsersCount + 1;
    }

    //lấy tất cả những user từng được share gói premium
    public function getAllSharedUsersCount(): int
    {
        return SharePremium::where('premium_registration_id', $this->registration_id)
            ->count();
    }

    //lấy số user còn có thể được share gói premium
    public function getAvailableShares(): int
    {
        $currentUsersCount = $this->getCurrentUsersCount();
        $package = $this->package;
        return $package->share_limit - $currentUsersCount;
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

    public static function getAllNoCondition()
    {
        return self::query()->get();
    }

    //lấy những user được share gói premium theo id của premium registration
    //lấy những tất cả user được share gói premium theo id của premium registration
    public function sharedUsers()
    {
        return $this->hasMany(SharePremium::class, 'premium_registration_id', 'registration_id');
    }

    //lấy những user được share premium mà gói premium đó đang sử dụng, chỉ dùng khi gói premium đó còn hạn
    public function getCurrentSharedUsers(){

        return $this->sharedUsers()
            ->whereHas('user', function ($query) {
                $query->where('expiry_date', '>', date('Y-m-d H:i:s'));
            })
            ->get();
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
