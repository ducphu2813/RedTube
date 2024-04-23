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

    public static function isUserPremiumActive(int $userId): bool
    {
        $currentDate = date('Y-m-d H:i:s');
        return self::query()
            ->where('user_id', $userId)
            ->where('end_date', '>', $currentDate)
            ->exists();
    }

    public static function getExpiredPremiumRegistrations(int $userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('user_id', $userId)
            ->where('end_date', '<', $currentDate)
            ->get();

        return $result;
    }

    public static function getCurrentPremiumRegistration(int $userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        $result = self::query()
            ->where('user_id', $userId)
            ->where('end_date', '>', $currentDate)
            ->first();

        return $result;


//        "SELECT * FROM premium_registration WHERE user_id = :userId AND end_date > :currentDate LIMIT 1";

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
