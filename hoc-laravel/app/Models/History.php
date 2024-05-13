<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'history';

    protected $primaryKey = 'history_id';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'video_id',
        'created_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'video_id');
    }

    //hàm create
    public function createHistory($data){
        return $this->create($data);
    }

    //lấy lịch sử xem video theo user_id
    public static function getHistoryByUserId($user_id){
        return self::query()
            ->where('user_id', $user_id)
            ->orderBy('created_date', 'desc')
            ->get();
    }
}
