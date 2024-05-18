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

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    public function getRootComments(): HasMany
    {

        return $this->hasMany(Comment::class, 'video_id')
            ->whereNull('reply_id')
            ->orderBy('created_date', 'desc');
    }

    public function getCategories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Category::class,
            VideoCategory::class,
            'video_id', // khóa ngoại của bảng VideoCategory
            'category_id', // khóa chính của bảng Category
            'video_id',  // khóa chính của bảng Video
            'category_id' // khóa ngoại của bảng Category
        );

        // SELECT * FROM category WHERE category_id IN (SELECT category_id FROM video_category WHERE video_id = $this->video_id)
    }

    public function getTags(): HasManyThrough
    {
        return $this->hasManyThrough(
            Tag::class,
            VideoTag::class,
            'video_id', // khóa ngoại của bảng VideoTag
            'tag_id', // khóa chính của bảng Tag
            'video_id',  // khóa chính của bảng Video
            'tag_id' // khóa ngoại của bảng Tag
        );
    }

    public function video_categories(): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class);
    }

    public static function getVideoByCategoryId($category_id)
    {
        return self::query()->where('category_id', $category_id)->get();
    }

    public static function getVideosByCategoryIds($categoryIds, $listVideo)
    {
        return $listVideo->filter(function ($video) use ($categoryIds) {
            return $video->getCategories->whereIn('category_id', $categoryIds)->isNotEmpty();
        });
    }

    public static function getVideoByCategoryName($category_name)
    {
        return self::query()->where('category_name', $category_name)->get();
    }

    public static function getVideoByUserId($user_id)
    {
        return self::query()->where('user_id', $user_id)->get();
    }

    //search theo title
    public static function searchVideo($title)
    {
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
    public static function getVideoAccept()
    {
        return self::query()->where('is_approved', 1)->get();
    }

    public static function getAllVideoIsNotApproved()
    {
        return self::query()->where('is_approved', null)->get();
    }

    public static function getVideoDeny()
    {
        return self::query()->where('is_approved', 0)->get();
    }

    // Lấy video chưa xét duyệt
    public static function getAllVideoIsApproved()
    {
        return self::query()->whereNotNull('is_approved')->get();
    }

    public function getVideosByNameSimilarity($videos, $video_name)
    {
        // Mảng ánh xạ các ký tự tiếng Việt có dấu với các ký tự Latin không dấu
        $vietnameseChars = array('à', 'á', 'ả', 'ã', 'ạ', 'ă', 'ằ', 'ắ', 'ẳ', 'ẵ', 'ặ', 'â', 'ầ', 'ấ', 'ẩ', 'ẫ', 'ậ', 'đ', 'è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ề', 'ế', 'ể', 'ễ', 'ệ', 'ì', 'í', 'ỉ', 'ĩ', 'ị', 'ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ồ', 'ố', 'ổ', 'ỗ', 'ộ', 'ơ', 'ờ', 'ớ', 'ở', 'ỡ', 'ợ', 'ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ừ', 'ứ', 'ử', 'ữ', 'ự', 'ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ');
        $latinChars = array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y');
        //ko làm như này nữa nhé

        return $videos->filter(function ($video) use ($video_name, $vietnameseChars, $latinChars) {
            // Thay thế các ký tự tiếng Việt có dấu bằng các ký tự Latin không dấu trong tên video và tên video_name
            $videoWithoutMark = str_replace($vietnameseChars, $latinChars, $video->title);
            $videoNameWithoutMark = str_replace($vietnameseChars, $latinChars, $video_name);

            // Loại bỏ các ký tự không phải chữ cái và số từ chuỗi tên video và tên video_name
            $videoCleaned = preg_replace('/[^a-zA-Z0-9]/', '', $videoWithoutMark);
            $videoNameCleaned = preg_replace('/[^a-zA-Z0-9]/', '', $videoNameWithoutMark);

            // Chuyển về chữ thường
            $videoLowerCase = mb_strtolower($videoCleaned);
            $videoNameLowerCase = mb_strtolower($videoNameCleaned);

            // Sử dụng hàm strpos() để kiểm tra xem tên video có chứa video_name không
            return strpos($videoLowerCase, $videoNameLowerCase) !== false;
        });
    }

    //hàm này lấy tất cả video
    public static function getAllVideo(){
        return self::query()
            ->orderBy('created_date', 'desc')
            ->get();
    }

    //hàm lấy các video có thể coi ở home
    public static function getAllAvailableVideo(){
        return self::query()
            ->where('is_approved', '=', 1)
            ->where('active', '=', 1)
            ->where('display_mode', '=', 1)
            ->orderBy('created_date', 'desc')
            ->get();

        // SELECT * FROM video WHERE is_approved = 1 AND active = 1 AND display_mode = 1 ORDER BY created_date DESC
    }

    //hàm này update video theo id
    public function updateVideo($id, $data)
    {
        return $this->where('video_id', $id)->update($data);
    }

    public static function getVideoById($id)
    {
        return self::where('video_id', $id)->first();
    }

    public static function deleteVideoById($id)
    {
        return self::where('video_id', $id)->delete();
    }

    // Dương không code nữa

    //hàm create video
    public function createVideo($data)
    {
        return $this->create($data);
    }


    //tăng view của video
    public function increaseView($id)
    {
        $video = $this->find($id);
        $video->view = $video->view + 1;
        $video->save();
    }

    //lấy danh sách video dựa trên danh sách category_id
    public static function getRelatedVideos($categoryIds)
    {
        return self::query()
            ->whereHas('getCategories', function ($query) use ($categoryIds) {
                $query->whereIn('category.category_id', $categoryIds);
            })
            ->distinct()
            ->get();

        // SELECT * FROM video WHERE video_id IN (SELECT video_id FROM video_category WHERE category_id IN (1, 2, 3))
    }

    // Hàm lấy số lượt like của video
    public function getLikesCount()
    {
        return $this->hasMany(Interaction::class, 'video_id')
            ->where('reaction', 1)
            ->count();
    }

    // Hàm lấy số lượt dislike của video
    public function getDislikesCount()
    {
        return $this->hasMany(Interaction::class, 'video_id')
            ->where('reaction', 0)
            ->count();
    }

    //Hàm lấy số comment
    public function getCommentsCount()
    {
        return $this->hasMany(Comment::class, 'video_id')
            ->count();
    }
}
