<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

// <<<<<<< HEAD
//     // Đếm ngày user
//     public static function countUser($year){
//         return self::whereYear('created_Date', $year)->count();
//     }

    
// =======
//     public function videos(): HasMany{

//         return $this->hasMany(Video::class, 'user_id');
//     }

//     public function comments(): HasMany{

//         return $this->hasMany(Comment::class, 'user_id');
//     }

//     public static function lastInsertId(){
//         return self::query()->latest('user_id')->first();
//     }

// >>>>>>> 9537bb7110dd81d0199cd4a0176f9b45ba89ab09
}
