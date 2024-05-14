<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'user_id',
        'created_date',
        'view',
        'description',
        'display_mode',
        'membership',
        'active',
        'video_path',
        'thumbnail_path',
        'is_approved',
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
            ->whereNull('reply_id')
            ->orderBy('created_date', 'desc');
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

    //search theo title
    public static function searchVideo($title){
        return self::query()->where('title', 'like', '%' . $title . '%')->get();
    }

    //hàm lấy 1 review của video
    public function review(): HasOne
    {
        return $this->hasOne(ReviewHistory::class, 'video_id');
    }
    //có thể lấy review của 1 video như sau: (dưới đây chỉ là ví dụ)
    // $video = Video::find(id cần tìm nha);
    // $review = $video->review;

    // Dương code ở này
    public static function showVideoApproved(){
        return self::query()->where('is_approved', 1)->get();
    }

    public static function getAllVideoNotApproved(){
        return self::query()->where('is_approved', 0)->get();
    }
    
    //hàm này lấy tất cả video
    public static function getAllVideo(){
        return self::query()->get();
    }

    //hàm này update video theo id
    public function updateVideo($id, $data){
        return $this->where('video_id', $id)->update($data);
    }

    public static function getVideoById($id){
        return self::where('video_id', $id)->first();
    }

    // Dương không code nữa

    //hàm create video
    public function createVideo($data){
        return $this->create($data);
    }


    //tăng view của video
    public function increaseView($id){
        $video = $this->find($id);
        $video->view = $video->view + 1;
        $video->save();
    }
}
