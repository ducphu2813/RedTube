<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMembership extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_membership';

    protected $primaryKey = 'subscription_id';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'membership_id',
        'start_date',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }

    //lấy tất cả thông tin gói thành viên của người dùng(người mua)
    public static function getUserMembership($user_id)
    {
        return self::query()->where('user_id', $user_id)->get();
    }

    //tìm theo subscription_id
    public static function getUserMembershipById($subscription_id)
    {
        return self::query()->where('subscription_id', $subscription_id)->first();
    }
}
