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

    protected $primaryKey = 'comment_id';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    protected $fillable = [
        'content',
        'created_date',
        'user_id',
        'video_id',
        'reply_id',
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
        return $this->belongsTo(Comment::class, 'reply_id');
    }

    public function getReplyComments(): HasMany{
        return $this->hasMany(Comment::class, 'reply_id', 'comment_id');
    }

    public static function getRootCommentsByVideoId(int $videoId): Collection{

        return self::query()
            ->where('video_id', $videoId)
            ->whereNull('reply_id')
            ->orderBy('created_date', 'desc')
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

    public static function getCountCommentByVideoId(int $videoId){
        return self::where('video_id', $videoId)->count();
    }

    public static function getCountReplyCommentByCommentId(int $commentId){
        return self::where('reply_id', $commentId)->count();
    }

    public static function deleteComment(int $commentId){
        return self::where('comment_id', $commentId)->delete();
    }

    public static function updateComment(int $commentId, $data){
        return self::where('comment_id', $commentId)->update($data);
    }

    public static function getRootCommentByUserId(int $userId){
        return self::where('user_id', $userId)
            ->whereNull('reply_id')
            ->orderBy('created_date', 'desc')
            ->get();
    }

}
