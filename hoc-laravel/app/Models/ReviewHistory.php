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
        'review_time',
        'review_status',
    ];

    protected $casts = [
        'review_time' => 'datetime',
    ];

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'reviewer_id', 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public static function getAllReviewHistory(){
        return self::query()->get();
    }

    public static function createNewReview($data)
    {
        return self::create($data);
    }

    public static function lastInsertId(){
        return self::query()->latest('review_id')->first();
    }


}
