<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'comment';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'video_id');
    }

    public function reply(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'reply_id', 'comment_id');
    }

    public function getReplyComments(): HasMany{
        return $this->hasMany(Comment::class, 'reply_id', 'comment_id');
    }

    public static function getRootCommentsByVideoId(int $videoId): Collection{

        return self::where('video_id', $videoId)
            ->whereNull('reply_id')
            ->orderBy('created_date', 'DESC')
            ->get();
    }

    public static function getReplyCommentsByCommentId(int $commentId): Collection{

        return self::where('reply_id', $commentId)
            ->get();
    }

    public static function saveComment($data){
        return self::query()->insert($data);
    }

    public static function lastInsertId(){
        return self::query()->latest('comment_id')->first();
    }

}
