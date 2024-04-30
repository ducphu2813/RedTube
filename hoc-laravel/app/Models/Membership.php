<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'membership';

    protected $primaryKey = 'membership_id';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'duration',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
