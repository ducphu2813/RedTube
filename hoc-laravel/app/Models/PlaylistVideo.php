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

    public function playlist(): BelongsTo{

        return $this->belongsTo(Playlist::class);
    }

    public function video(): BelongsTo{

        return $this
            ->belongsTo(Video::class, 'video_id', 'video_id');
    }

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

    public function isVideoInPlaylist($playlist_id, $video_id){
        return self::query()
            ->where('video_id', $video_id)
            ->where('playlist_id', $playlist_id)
            ->exists();
    }
}
