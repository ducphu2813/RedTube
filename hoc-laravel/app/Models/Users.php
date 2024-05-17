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

    //tìm user theo tên, trả về danh sách user
    public static function getUsersByName($name){
        return self::where('user_name', 'LIKE', '%' . $name . '%')->get();
    }

    //tìm user theo tên, tìm theo đúng chính xác tên, trả về user đầu tiên
    public static function getUserByName($name){
        return self::whereRaw('BINARY `user_name` = ?', [$name])->first();
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

    public function videos(): HasMany{

        return $this->hasMany(Video::class, 'user_id');
    }

    public function comments(): HasMany{

        return $this->hasMany(Comment::class, 'user_id');
    }

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
    //đếm số lượng follow(subcribe) của user
    //cách dùng: $user = Users::find(1);
    //$followersCount = $user->followersCount();
    public function followersCount()
    {
        return $this->hasMany(Follow::class, 'user_id')->count();
    }

    public function videosCount() {
        return $this->hasMany(Video::class, 'user_id')->count();
    }

    //lấy danh sách Users dựa trên danh sách được follow bởi user
    public function getUsersByFollowing(){
        return $this->belongsToMany(Users::class, 'follow', 'follower_id', 'user_id')->get();
    }

    //lấy danh sách Users dựa trên danh sách đang follow user
    public function getUsersBFollowed(){
        return $this->belongsToMany(Users::class, 'follow', 'user_id', 'follower_id');
    }

    //lấy danh sách các Follow đang follow user
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

    //lấy danh sách các Follow được follow bởi user
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

    //lấy các gói membership của user(người tạo)
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class, 'user_id');
    }
    //cách dùng: $user = Users::find(1);
    // $memberships = $user->memberships;

    //kiểm tra xem user có đăng ký gói membership nào của user hiện tại không
    public function hasMembershipFrom($creator_id, $subscriber_id)
    {
        // Lấy tất cả gói membership của User A
        $memberships = Membership::where('user_id', $creator_id)->pluck('membership_id');

        // Kiểm tra xem User B có đăng ký bất kỳ gói membership nào của User A hay không
        return UserMembership::where('user_id', $subscriber_id)
            ->whereIn('membership_id', $memberships)
            ->where('end_date', '>', now())
            ->exists();
    }
    //cách dùng: $user = Users::find(1);
    // $user->hasMembershipFrom(2, 3) để kiểm tra xem user có đăng ký gói membership nào của user có id = 2 không

    //lấy tổng số video của user
    public function videoCount(){
        return $this->hasMany(Video::class, 'user_id')->count();
    }

    //lấy tổng view của user từ tất cả video
    public function totalView(){
        return $this->hasMany(Video::class, 'user_id')->sum('view');
    }

    //lấy tổng follow của user
    public function totalFollow(){
        return $this->hasMany(Follow::class, 'user_id')->count();
    }

    //lấy tổng like của user
    public function totalLikes(){
        return $this->hasManyThrough(Interaction::class, Video::class, 'user_id', 'video_id')
            ->where('reaction', 1)
            ->count();
    }

    //lấy dữ liệu thống kê cho admin
    public static function getUserRegistrationStatsByYear($year)
    {
        // Khởi tạo mảng để lưu trữ số lượng người dùng đăng ký trong từng tháng
        $monthlyRegistrations = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRegistrations[$month] = 0;
        }

        // Lấy tất cả người dùng đăng ký trong năm
        $users = self::query()
            ->whereYear('created_date', $year)
            ->get();

        // Tính toán số lượng người dùng đăng ký trong từng tháng
        foreach ($users as $user) {
            $month = $user->created_date->month;
            $monthlyRegistrations[$month]++;
        }

        // Tính tổng số lượng người dùng đăng ký trong năm
        $totalRegistrations = array_sum($monthlyRegistrations);

        // Trả về mảng chứa số lượng người dùng đăng ký trong từng tháng, cũng như tổng số người dùng đăng ký trong năm
        return [
            'monthlyRegistrations' => $monthlyRegistrations,
            'totalRegistrations' => $totalRegistrations,
        ];
    }

}
