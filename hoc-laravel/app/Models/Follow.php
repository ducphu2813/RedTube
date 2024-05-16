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

    //đếm số lượng follow theo user_id
    public static function countFollow($user_id)
    {
        return self::where('user_id', $user_id)->count();
    }

    //lấy dữ liệu follow trong 1 năm theo từng tháng của user_id
    public static function getFollowStatsByYear($year, $user_id)
    {
        // Khởi tạo mảng để lưu trữ số lần đăng ký trong từng tháng
        $monthlyFollows = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyFollows[$month] = self::whereYear('created_date', $year)
                ->whereMonth('created_date', $month)
                ->where('user_id', $user_id)
                ->count();
        }

        // Tính tổng số lần đăng ký trong năm
        $totalFollows = array_sum($monthlyFollows);

        // Trả về mảng chứa số lần đăng ký trong từng tháng và tổng số lần đăng ký
        return [
            'monthlyFollows' => $monthlyFollows,
            'totalFollows' => $totalFollows,
        ];
    }
}
