<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function index(){
    }

    public function handleFollow(Request $request)
    {
        $user_id = $request->input('user_id');

        $follower_id = $request->input('follower_id');

        //kiểm tra nếu là chính user_id thì không thể follow
        if($follower_id == $user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau',
            ]);
        }

        //khi chưa đăng nhập
        else if($follower_id == null) {
            return response()->json([
                'status' => 'not_logged_in',
                'message' => 'Bạn cần đăng nhập để thực hiện chức năng này',
            ]);
        }

        $checkFollow = Follow::checkFollow($user_id, $follower_id);

        if($checkFollow) {

            //nếu đã follow thì hủy follow
            Follow::deleteFollow($user_id, $follower_id);
            return response()->json([
                'status' => 'unfollow',
                'message' => 'Đã hủy đăng ký',
            ]);
        }

        Follow::createFollow($user_id, $follower_id);
        return response()->json([
            'status' => 'followed',
            'message' => 'Đăng ký thành công',
        ]);
    }
}
