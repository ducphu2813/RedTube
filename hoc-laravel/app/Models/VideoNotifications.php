<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoNotifications extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $primaryKey = 'notification_id';

    protected $fillable = [
        'user_id',
        'video_id',
        'message',
        'created_date',
        'is_read',
    ];

    protected $casts = [
//        'created_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public static function createNewNotification($data)
    {
        return self::create($data);
    }

    //lấy tất cả theo user_id
    public static function getNotificationByUserId($user_id)
    {
        return self::query()
            ->where('user_id', $user_id)
            ->get();
    }
}
