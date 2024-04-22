<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{

    public function __construct()
    {

        echo 'Khởi động DashBoardController';
        echo '<br>';

        //chúng ta sẽ thường kiểm tra phân quyền ở đây trước khi cho phép truy cập vào trang quản trị
        // cách truyền thống là sử dụng session để check login và quyền
    }

    public function index()
    {

        if(!session('loggedInUser')){
            return redirect()->route('login-register');
        }

        else if(session('userPermission') == 1){
            return 'Mày đéo có đủ quyền truy cập vào trang này';
        }

        else{

            return 'Đây là trang quản trị';
        }
    }

}
