<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function index()
    {

    }

    public function handleLike(Request $request)
    {
        $user_id = $request->input('user_id');

        $video_id = $request->input('video_id');

        $reaction = $request->input('react');

        if(!session('loggedInUser')) {

            return response()->json([
                'status' => 'not_logged_in',
                'message' => 'Chưa đăng nhập, vui lòng đăng nhập để thực hiện thao tác này',
            ]);
        }

        if($reaction == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau',
            ]);
        }

        if($reaction == 'like'){
            $reaction = 1;
        } else {
            $reaction = 0;
        }

        $interaction = new Interaction();

        $checkInteraction = $interaction->checkInteraction($user_id, $video_id, $reaction);

        if($checkInteraction) {

            //nếu đã có react thì hủy react đó
            $interaction->deleteInteraction($user_id, $video_id, $reaction);

            if($reaction == 1)
                return response()->json([
                    'status' => 'unset_react',
                    'message' => 'Đã hủy like',
                ]);
            else {
                return response()->json([
                    'status' => 'unset_react',
                    'message' => 'Đã hủy dislike',
                ]);
            }
        }

        //trước tiên cần kiểm tra xem đã có !react chưa, nếu có thì xóa !react
        $interaction->deleteInteraction($user_id, $video_id, !$reaction);
        //sau đó thì tạo mới react
        $interaction->createInteraction($user_id, $video_id, $reaction);
        if($reaction == 1)
            return response()->json([
                'status' => 'liked',
                'message' => 'Đã like',
            ]);
        else {
            return response()->json([
                'status' => 'disliked',
                'message' => 'Đã dislike',
            ]);
        }
    }
}
