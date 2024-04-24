<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoTag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'video_tag';

    protected $fillable = [
        'video_id',
        'tag_id',
    ];

    public function video(): BelongsTo{

        return $this->belongsTo(Video::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
