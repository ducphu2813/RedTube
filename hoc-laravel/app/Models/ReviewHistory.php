<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'review_history';

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'reviewer_id',
        'video_id',
        'note',
        'review_date',
        'review_status',
    ];

    protected $casts = [
        'review_date' => 'datetime',
    ];

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'reviewer_id', 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
