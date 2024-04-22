<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(PremiumPackage::class, 'package_id');
    }
}
