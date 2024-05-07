<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Users;
use Illuminate\Http\Request;

class CommentController extends Controller{

    public function index(){
        $allComments = Comment::all();
    }



    public function getCommentByVideoId(int $video_id){
        $comments = Comment::getRootCommentsByVideoId($video_id);

        return view('comments.root-cmt', ['comments' => $comments]);

//        return response()->json($comments);
    }



    public function getReplyCommentsByCommentId(int $comment_id){
        $comments = Comment::getReplyCommentsByCommentId($comment_id);

        return response()->json($comments);
    }

    //lưu comment gốc
    public function saveRootComment(Request $request){

        $data = request()->all();

        if(!$request->session()->has('loggedInUser')){
            return response()->json(['status' => 'not_logged_in']);
        }

        else{
            $data['user_id'] = $request->session()->get('loggedInUser');
            $data['user_name'] = Users::getUserById($data['user_id'])->user_name;
            $data['created_date'] = date('Y-m-d H:i:s');
//        unset($data['_token']);
            $data['reply_id'] = null;

            //route này để gắn vào form reply, phương thức post
            $data['reply_route'] = route('comments.reply.save');
            $data['csrf_token'] = csrf_token();
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";

//        echo route('comments.reply', ['comment_id' => 1]);

            //save comment
            $comment = [
                'video_id' => $data['video_id'],
                'user_id' => $data['user_id'],
                'content' => $data['content'],
                'created_date' => $data['created_date'],
                'reply_id' => $data['reply_id']
            ];

            Comment::saveComment($comment);

            $data['comment_id'] = Comment::lastInsertId();
            $data['status'] = 'success';

            return response()->json($data);
        }



//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";

//        Comment::saveComment($data);
    }

    //lưu comment trả lời
    public function saveReplyComment(Request $request)
    {
        if(!$request->session()->has('loggedInUser')){
            return response()->json(['status' => 'not_logged_in']);
        }
        else{
            $data = request()->all();

            $data['user_id'] = $request->session()->get('loggedInUser');
            $data['user_name'] = Users::getUserById($data['user_id'])->user_name;
            $data['created_date'] = date('Y-m-d H:i:s');
            unset($data['_token']);

            if (!isset($data['content'])) {
                $data['content'] = 'content is missing';
            }

            $comment = [
                'video_id' => $data['video_id'],
                'user_id' => $data['user_id'],
                'content' => $data['content'],
                'created_date' => $data['created_date'],
                'reply_id' => $data['reply_id']
            ];

            Comment::saveComment($comment);

            return response()->json($data);
        }



//        echo "<pre>";
//        print_r($view);
//        echo "</pre>";
    }


}
