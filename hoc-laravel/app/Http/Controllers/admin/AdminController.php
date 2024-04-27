<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // hàm hiển thị trang danh sách video
    public function showVideoList(){
        return view('admin.videoWrapper');
    }

    // hàm hiển thị trang danh sách user
    public function showUserList(){
        $listUser = Cache::remember('list_user', 60, function () {
            return Users::getAllUsers();
        });

        return view('admin.userWrapper', ['listUser' => $listUser]);
    }

    // hàm hiển thị trang danh sách comment
    public function showCommentList(){
        return view('admin.commentWrapper');
    }

    // hàm hiển thị trang danh sách check
    public function showCheckList(){
        return view('admin.checkWrapper');
    }

    // hàm hiển thị trang danh sách chart
    public function showChartList(){
        return view('admin.chartWrapper');
    }

    // hàm hiển thị trang quản lý
    public function showAll(){
        return view('admin.layout');
    }

}
