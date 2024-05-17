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
            'category_id', // khóa ngoại của bảng VideoCategory(trung gian)
            'video_id', // khóa
            'category_id', // khóa chính của bảng Category
            'video_id' // khóa ngoại của bảng Video
        );

//        SELECT * FROM videos
//        INNER JOIN video_categories ON videos.video_id = video_categories.video_id
//        INNER JOIN categories ON categories.category_id = video_categories.category_id
//        WHERE categories.category_id = ?;

    }

    public static function getAll(){
        return self::query()->get();

        // Select * from category
    }

    public static function getCategoryById($id){
        return self::query()->where('category_id', $id)->first();

        //Select * from category where category_id = ?
    }

    public static function getCategoriesByName($name)
    {
        return self::where('name', 'LIKE', '%' . $name . '%')->get();

        //Select * from category where name like %name%
    }

    public function createCategory($data){
        return $this->create($data);

        //Insert into category values
    }

    public function updateCategory($id, $data){
        return $this->where('category_id', $id)->update($data);

        //Update category set data = ? where category_id = ?
    }

    public function deleteCategory($id){
        return $this->where('category_id', $id)->delete();

        //delete from category where category_id = ?
    }

}
