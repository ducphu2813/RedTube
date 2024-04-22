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

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function premiumRegistration(): BelongsTo
    {
        return $this->belongsTo(PremiumRegistration::class);
    }
}
