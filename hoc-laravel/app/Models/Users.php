<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    use HasFactory;

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
        'created_date',
        'active',
        'description',
        'picture_url',
        'token',
        'token_expire',
    ];

    public $timestamps = false;


    public static function getAllUsers(){
        return self::query()->get();
    }

    public static function getUserById($id)
    {
        return self::query()->where('user_id', $id)->first();
    }

    public static function getUsersByName($name)
    {
        return self::where('user_name', 'LIKE', '%' . $name . '%')->get();
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

    public static function lastInsertId(){
        return self::query()->latest('user_id')->first();
    }

}
