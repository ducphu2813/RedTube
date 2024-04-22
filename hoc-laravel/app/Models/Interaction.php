<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'interaction';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'video_id');
    }
}
