<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'payment_history';

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'payment_id',
        'user_id',
        'payment_date',
        'amount',
        'full_name',
        'address',
        'phone',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    //create
    public static function createPaymentHistory($data)
    {
        return self::create($data);
    }

    //get by user id
    public static function getPaymentHistoryByUserId($user_id)
    {
        return self::where('user_id', $user_id)
            ->orderBy('payment_date', 'desc')
            ->get();
    }

    //get by payment id
    public static function getPaymentHistoryByPaymentId($payment_id)
    {
        return self::where('payment_id', $payment_id)
            ->first();
    }
}
