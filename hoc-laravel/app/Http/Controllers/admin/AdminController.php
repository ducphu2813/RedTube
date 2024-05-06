<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;



class AdminController extends Controller
{

    // hàm hiển thị trang danh sách video
    public function showVideoList(){
        $listVideo = Cache::remember('list_video', 0, function (){
            return Video::getAllVideo();
        });
        return view('admin.videoWrapper', ['listVideo' => $listVideo]);
    }

    // hàm hiển thị trang danh sách user
    public function showUserList(){
        $listUser = Cache::remember('list_user', 0, function () {
            return Users::getAllUsers();
        });
        return view('admin.userWrapper', ['listUser' => $listUser]);
    }

    // hàm hiển thị trang danh sách comment
    // public function showCommentList(){
    //     return view('admin.commentWrapper');
    // }

    // hàm hiển thị trang danh sách check
    public function showCheckList(){
        return view('admin.checkWrapper', ['listCheck' => Video::getAllVideo()]);
    }

    // hàm hiển thị trang quản lý
    public function showAll(){
        return view('admin.layout');
    }

    // User
    // hàm thay đổi trạng thái user
    public function changeRoleUser(Request $request){
        $data = $request->all();
        $id = $data['user_id'];
        $role = $data['role'];
        $user = new Users();
        $user->updateUser($id, ['role' => $role]);
    }

    // hàm khóa hoặc mở khóa user
    public function changeStatusUser(Request $request){
        $data = $request->all();
        $id = $data['user_id'];
        $active = $data['active'];
        $user = new Users();
        $user->updateUser($id, ['active' => $active]);
    }

    // Video
    // hàm khóa hoặc mở khóa video
    public function changeStatusVideo(Request $request){
        $data = $request->all();
        $id = $data['video_id'];
        $active = $data['active'];
        $video = new Video();
        $video->updateVideo($id, ['active' => $active]);
    }

    // Check video
    
    // Analysis data
    public function showChartList(){
        return view('admin.chartWrapper');
    }
}
