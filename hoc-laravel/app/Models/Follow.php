<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'follow';

    protected $table = 'follow';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'follower_id',
        'created_date',
    ];

    //kiểm tra xem user_id đã được follow bởi follower_id chưa
    public static function checkFollow($user_id, $follower_id)
    {
        return self::where('user_id', $user_id)
            ->where('follower_id', $follower_id)
            ->exists();
    }

    protected $fillable = [
        'user_id',
        'follower_id',
        'created_date',
    ];

    //kiểm tra xem user_id đã được follow bởi follower_id chưa
    public static function checkFollow($user_id, $follower_id)
    {
        return self::where('user_id', $user_id)
            ->where('follower_id', $follower_id)
            ->exists();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function follower(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'follower_id');
    }

    //create
    public static function createFollow($user_id, $follower_id){

        $data = [
            'user_id' => $user_id,
            'follower_id' => $follower_id,
            'created_date' => now(),
        ];

        return self::create($data);
    }

    //delete
    public static function deleteFollow($user_id, $follower_id)
    {
        return self::where('user_id', $user_id)
            ->where('follower_id', $follower_id)
            ->delete();
    }

    public static function countFollow($user_id)
    {
        return self::where('user_id', $user_id)->count();
    }
}
