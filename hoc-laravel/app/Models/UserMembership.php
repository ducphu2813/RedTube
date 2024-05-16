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

    //lấy dữ liệu thống kê
    public static function getMembershipStatsByYear($year, $creator_id)
    {
        // Khởi tạo mảng để lưu trữ số lượng người đăng ký và tổng số tiền trong từng tháng
        $monthlySubscriptions = [];
        $monthlyRevenue = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlySubscriptions[$month] = 0;
            $monthlyRevenue[$month] = 0;
        }

        // Lấy tất cả các lịch sử đăng ký membership trong năm mà membership_id thuộc về user hiện tại
        $memberships = self::query()
            ->whereYear('start_date', $year)
            ->whereHas('membership', function ($query) use ($creator_id) {
                $query->where('user_id', $creator_id);
            })
            ->get();

        // Tính toán số lượng người đăng ký và tổng số tiền trong từng tháng
        foreach ($memberships as $membership) {
            $month = $membership->start_date->month;
            $monthlySubscriptions[$month]++;
            $monthlyRevenue[$month] += $membership->membership->price;
        }

        // Tính tổng số lượng người đăng ký và tổng số tiền trong năm
        $totalSubscriptions = array_sum($monthlySubscriptions);
        $totalRevenue = array_sum($monthlyRevenue);

        // Trả về mảng chứa số lượng người đăng ký và tổng số tiền trong từng tháng, cũng như tổng số người đăng ký và tổng số tiền trong năm
        return [
            'monthlySubscriptions' => $monthlySubscriptions,
            'monthlyRevenue' => $monthlyRevenue,
            'totalSubscriptions' => $totalSubscriptions,
            'totalRevenue' => $totalRevenue,
        ];
    }
}
