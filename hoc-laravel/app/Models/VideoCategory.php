<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'video_category';

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Thêm thể loại vào trong video
    public function addCategoryToVideo($video_id, $category_id)
    {
        $exists = $this->isCategoryInVideo($video_id, $category_id);

        if(!$exists){
            return $this->insert([
                'video_id' => $video_id,
                'category_id' => $category_id,
            ]);
        }

        return null;
    }

    // Kiểm tra xem danh mục đã tồn tại trong video chưa
    public function isCategoryInVideo($category_id, $video_id){
        return self::query()
            ->where('video_id', $video_id)
            ->where('category_id', $category_id)
            ->exists();
    }

    
    
}
