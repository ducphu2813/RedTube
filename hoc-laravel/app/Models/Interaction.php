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

    protected $fillable = [
        'user_id',
        'video_id',
        'created_date',
        'reaction',
    ];

    //check
    public function checkInteraction($user_id, $video_id, $reaction){
        return $this->where('user_id', $user_id)
                    ->where('video_id', $video_id)
                    ->where('reaction', $reaction)
                    ->exists();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'video_id');
    }

    //create
    public function createInteraction($user_id, $video_id, $reaction){

        $data = [
            'user_id' => $user_id,
            'video_id' => $video_id,
            'created_date' => date('Y-m-d H:i:s'),
            'reaction' => $reaction,
        ];

        return $this->create($data);
    }

    //delete
    public function deleteInteraction($user_id, $video_id, $reaction){
        return $this->where('user_id', $user_id)
                    ->where('video_id', $video_id)
                    ->where('reaction', $reaction)
                    ->delete();

    }
}
