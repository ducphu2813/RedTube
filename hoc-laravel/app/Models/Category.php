<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'category';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
    ];

    // public function video()
    // {
    //     return $this->belongsToMany(Video::class, 'video_category', 'category_id', 'video_id');
    // }

    public function getVideos(): HasManyThrough{

        return $this->hasManyThrough(
            Video::class,
            VideoCategory::class,
            'category_id', // khóa ngoại của bảng VideoCategory
            'video_id', // khóa chính của bảng Video
            'category_id', // khóa chính của bảng Category
            'video_id' // khóa ngoại của bảng Video
        );

    }

    public static function getAll(){
        return self::query()->get();
    }

    public static function getCategoryById($id){
        return self::query()->where('category_id', $id)->first();
    }

    public static function getCategoriesByName($name)
    {
        return self::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    public function createCategory($data){
        return $this->create($data);
    }

    public function updateCategory($id, $data){
        return $this->where('category_id', $id)->update($data);
    }

    public function deleteCategory($id){
        return $this->where('category_id', $id)->delete();
    }

}
