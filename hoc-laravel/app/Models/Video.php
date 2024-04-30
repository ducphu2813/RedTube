<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Video extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'video';

    protected $casts = [
        'created_date' => 'datetime',
    ];

    protected $primaryKey = 'video_id';

    protected $fillable = [
        'title',
        'users_id',
        'created_date',
        'view',
        'description',
        'display_mode',
        'membership',
        'active',
        'video_path',
        'thumbnail_path',
    ];

    public function user(): BelongsTo{
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

    public function getCategories(): HasManyThrough{
        return $this->hasManyThrough(
            Category::class,
            VideoCategory::class,
            'video_id', // khóa ngoại của bảng VideoCategory
            'category_id', // khóa chính của bảng Category
            'video_id',  // khóa chính của bảng Video
            'category_id' // khóa ngoại của bảng Category
        );
    }

    public function getTags(): HasManyThrough{
        return $this->hasManyThrough(
            Tag::class,
            VideoTag::class,
            'video_id', // khóa ngoại của bảng VideoTag
            'tag_id', // khóa chính của bảng Tag
            'video_id',  // khóa chính của bảng Video
            'tag_id' // khóa ngoại của bảng Tag
        );

    }

    public function video_categories (): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class);
    }

    public static function getVideoByCategoryId($category_id){
        return self::query()->where('category_id', $category_id)->get();
    }

    public static function getVideoByCategoryName($category_name){
        return self::query()->where('category_name', $category_name)->get();
    }

    public static function getVideoByUserId($user_id){
        return self::query()->where('user_id', $user_id)->get();
    }
}
