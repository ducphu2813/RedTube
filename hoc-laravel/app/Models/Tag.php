<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tag';

    protected $primaryKey = 'tag_id';

    protected $fillable = [
        'name',
    ];

public function videos(): HasManyThrough{
        return $this->hasManyThrough(
            Video::class,
            VideoTag::class,
            'tag_id', // khóa ngoại của bảng VideoTag
            'video_id', // khóa chính của bảng Video
            'tag_id',  // khóa chính của bảng Tag
            'video_id' // khóa ngoại của bảng Video
        );
    }
}
