<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';

    protected $primaryKey = 'video_id';

    public $timestamps = false;

//    protected $fillable = [
//        'video_name',
//        'video_url',
//        'description',
//        'user_id',
//        'created_date',
//        'view',
//        'like',
//        'dislike',
//        'active',
//    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    public function getRootComments(): HasMany{
        return $this->hasMany(Comment::class, 'video_id')
            ->whereNull('reply_id');
    }
}
