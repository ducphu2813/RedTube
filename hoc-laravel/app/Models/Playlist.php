<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Playlist extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'playlist';

    protected $primaryKey = 'playlist_id';

    protected $fillable = [
        'user_id',
        'name',
        'created_date',
    ];

    protected $casts = [
        'created_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }


    public function createPlaylist($data){
        return $this->create($data);
    }

    //lấy danh sách playlist theo user_id
    public static function getPlaylistByUserId($user_id){
        return self::query()->where('user_id', $user_id)->get();
    }


    public function videos(): HasManyThrough
    {
        return $this->hasManyThrough(
            Video::class,
            PlaylistVideo::class,
            'playlist_id', // Khóa ngoại trên bảng PlaylistVideo
            'video_id', // khóa ngoại trên bảng Video
            'playlist_id', // Khóa chính trên bảng Playlist
            'video_id'  // khóa chính trên bảng Video
        );
    }

    //lấy danh sách video trong playlist
    public function getVideosInPlaylist(){
        return $this->videos()->get();
    }

    //kiểm tra video có ở trong playlist không
    public function isVideoInPlaylist($video_id){
        return $this->videos()->where('playlist_video.video_id', $video_id)->exists();
    }
}