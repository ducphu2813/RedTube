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

    public function videos(): HasMany{

        return $this->hasMany(Video::class, 'user_id');
    }

    public function comments(): HasMany{

        return $this->hasMany(Comment::class, 'user_id');
    }

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


    // Đếm ngày user
    public static function countUser($year){
        return self::whereYear('created_Date', $year)->count();
    }

}
