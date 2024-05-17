<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SharePremium extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'share_premium';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    protected $primaryKey = 'share_id';

    protected $fillable = [
        'user_id',
        'premium_registration_id',
        'created_date',
    ];

    //kiểm tra user có đang sử dụng gói premium được share còn hạn hay không
    public static function isUserSharedPremium(int $userId): bool
    {
        return self::query()
            ->where('user_id', $userId)
            ->whereHas('premiumRegistration', function ($query) {
                $currentDate = date('Y-m-d H:i:s');
                $query->where('end_date', '>', $currentDate);
            })
            ->exists();
    }

    //lấy tất cả gói premium được share cho user và đã hết hạn
    public static function getExpiredSharedPremiumsByUser(int $userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('user_id', $userId)
            ->whereHas('premiumRegistration', function ($query) use ($currentDate) {
                $query->where('end_date', '<', $currentDate);
            })
            ->get();

        return $result;
    }

    //lấy gói premium đang chia sẻ của user
    public static function getCurrentSharedPremiumByUser(int $userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('user_id', $userId)
            ->where('expiry_date', '>', $currentDate)
            ->first();

        return $result;
    }

    public static function getAllSharedPremiumsByUser(int $userId)
    {
        return self::query()
            ->where('user_id', $userId)
            ->get();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function premiumRegistration(): BelongsTo
    {
        return $this->belongsTo(PremiumRegistration::class, 'premium_registration_id');
    }

}
