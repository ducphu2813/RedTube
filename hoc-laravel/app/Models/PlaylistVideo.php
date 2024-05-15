<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaylistVideo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'playlist_video';

    protected $fillable = [
        'playlist_id',
        'video_id',
    ];

    //quan hệ với bảng playlist
    //quan hệ với bảng playlist
    public function playlist(): BelongsTo{

        return $this->belongsTo(Playlist::class);
    }

    //quan hệ với bảng video
    //quan hệ với bảng video
    public function video(): BelongsTo{

        return $this
            ->belongsTo(Video::class, 'video_id', 'video_id');
    }

    //hàm này là để thêm video vào playlist đó
    //hàm này là để thêm video vào playlist đó
    public function addVideoToPlaylist($playlist_id, $video_id){

        $exists = $this->isVideoInPlaylist($playlist_id, $video_id);

        if(!$exists){
            return $this->create([
                'playlist_id' => $playlist_id,
                'video_id' => $video_id,
            ]);
        }
        return null;

    }

    public static function deleteAllFromPlaylist($playlist_id)
    {
        PlaylistVideo::where('playlist_id', $playlist_id)->delete();
    }   

    //hàm này là xóa video khỏi playlist
    public function removeVideoFromPlaylist($playlist_id, $video_id){

        $exists = $this->isVideoInPlaylist($playlist_id, $video_id);

        if(!$exists){
            return null;
        }

        return $this
            ->where('playlist_id', $playlist_id)
            ->where('video_id', $video_id)
            ->delete();
    }

    //hàm này kiểm tra xem video có trong playlist chưa
    //hàm này kiểm tra xem video có trong playlist chưa
    public function isVideoInPlaylist($playlist_id, $video_id){
        return self::query()
            ->where('video_id', $video_id)
            ->where('playlist_id', $playlist_id)
            ->exists();
    }
}
