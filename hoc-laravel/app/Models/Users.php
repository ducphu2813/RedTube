<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'created_date' => 'datetime',
    ];

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'channel_name',
        'email',
        'password',
        'description',
        'created_date',
        'active',
        'picture_url',
        'role',
    ];

    public static function getAllUsers(){
        return self::query()->get();
    }

    public static function getUserById($id)
    {
        return self::query()->where('user_id', $id)->first();
    }

    public static function getUsersByName($name){
        return self::where('user_name', 'LIKE', '%' . $name . '%')->get();
    }

    public function getPlaylists(){
        return $this->hasMany(Playlist::class, 'user_id', 'user_id');
    }

    public function createUser($data){
        return $this->create($data);
    }

    public function updateUser($id, $data){
        return $this->where('user_id', $id)->update($data);
    }

    public function deleteUser($id){
        return $this->where('user_id', $id)->delete();
    }


    // Đếm ngày user
    public static function countUser($year){
        return self::whereYear('created_Date', $year)->count();
    }


// =======
//     public function videos(): HasMany{

//         return $this->hasMany(Video::class, 'user_id');
//     }

//     public function comments(): HasMany{
//         return $this->hasMany(Comment::class, 'user_id');

//     public static function lastInsertId(){
//         return self::query()->latest('user_id')->first();
//     }

    public function videoNoti(): HasMany{
        return $this->hasMany(VideoNotifications::class, 'user_id');
    }
    //đây là hàm lấy các thông báo duyệt video của user
    //ví dụ lấy thông báo của user có id = 1
    // $user = Users::find(1);
    // $videoNoti = $user->videoNoti;

    public static function lastInsertId(){
        $lastUser = self::query()->latest('user_id')->first();
        return $lastUser ? (int) $lastUser->user_id : null;
    }


    //Đếm số người follower của user
    public function followersCount()
    {
        return $this->hasMany(Follow::class, 'user_id')->count();
    }
    //đếm số lượng follow(subcribe) của user
    //cách dùng: $user = Users::find(1);
    //$followersCount = $user->followersCount();

    //lấy danh sách các follower
    public function followers()
    {
        return $this->hasMany(Follow::class, 'user_id')->get();
    }
    //lấy danh sách các follower của user
    //cách dùng: $user = Users::find(1);
    // $followers = $user->followers();
    //$followers->isEmpty() để kiểm tra xem user có follower nào không

    //đếm số người mà user đang follow
    public function followingCount()
    {
        return $this->hasMany(Follow::class, 'follower_id')->count();
    }
    //đếm số lượng người mà user đang follow
    //cách dùng: $user = Users::find(1);
    //$followingCount = $user->followingCount();

    //lấy danh sách các user mà user đó đang follow
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id')->get();
    }
    //lấy danh sách các người mà user đang follow
    //cách dùng: $user = Users::find(1);
    // $following = $user->following();
    //$following->isEmpty() để kiểm tra xem user có đang follow ai không

    //kiểm tra xem user có follow user khác không
    public function isFollowing($user_id){

        return $this->hasMany(Follow::class, 'follower_id')->where('user_id', $user_id)->exists();

    }
    //cách dùng: $user = Users::find(1);
    // $user->isFollowing(2) để kiểm tra xem user có follow user có id = 2 không

    //kiểm tra xem user có được user khác follow không
    public function isFollowed($user_id){

        return $this->hasMany(Follow::class, 'user_id')->where('follower_id', $user_id)->exists();
    }
    //cách dùng: $user = Users::find(1);
    // $user->isFollowed(2) để kiểm tra xem user có được user có id = 2 follow không
}
