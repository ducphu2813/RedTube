<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ReviewHistory;
use App\Models\Users;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;



class AdminController extends Controller
{

    // hàm hiển thị trang danh sách video
    public function showVideoList(){
        $listVideo = Cache::remember('list_video', 0, function (){
            return Video::showVideoApproved();
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

        $videoNotApproved = Video::getAllVideoNotApproved();

        return view('admin.checkWrapper', ['listCheck' => $videoNotApproved]);
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
    // hàm duyệt video
    public function showCheckModal(Request $request){
        $data = $request->all();
        // Lấy video theo ID
        $video = Video::getVideoById($data['video_id']);
        // Lấy danh sách thể loại
        $category = Category::getAll();

        $data['category'] = $category;
        $data['video'] = $video;

        return view('admin.checkIsApproved', $data);
    }
    
    // hàm không duyệt video
    public function showCheckModalIgnore(Request $request){
        $data = $request->all();
        $video = Video::getVideoById($data['video_id']);
        $data['video'] = $video;
        return view('admin.checkIsNotApproved', $data);
    }

    // Analysis data
    public function showChartList(){
        return view('admin.chartWrapper');
    }

    // Category add to video
    public function acceptVideo(Request $request){

        $catevideo = new VideoCategory();
        $review = new ReviewHistory();
        $data = $request->all();
        $videoId = $data['video_id'];
        $categoryIds = $data['category_ids'];
        
        foreach ($categoryIds as $categoryId){
            $catevideo->addCategoryToVideo($videoId, $categoryId);
        }

        $data['reviewer_id'] = $request->session()->get('loggedInUser');
        $data['review_time'] = date('Y-m-d H:i:s');
        $data['review_status'] = 1;
        $data['note'] = 'Chúc mừng video của bạn đã được duyệt';

        $review_item = [
            'video_id' => $videoId,
            'reviewer_id' => $data['reviewer_id'],
            'review_time' => $data['review_time'],
            'review_status' => $data['review_status'],
            'note' => $data['note']
        ];

        $review->createNewReview($review_item);
        $data['status'] = 'accept';

        // Kiểm tra xem video đã được duyệt, cho ra public
        $video = Video::getVideoById($videoId);
        if($video){
            $video->is_approved = 1;
            $video->save();
        }

        return response()->json($data);
    }

    // hàm không duyệt video
    public function ignoreVideo(Request $request){
        $review = new ReviewHistory();
        $data = $request->all();
        $videoId = $data['video_id'];
        $message = $data['note'];

        $data['reviewer_id'] = $request->session()->get('loggedInUser');
        $data['review_time'] = date('Y-m-d H:i:s');
        $data['review_status'] = 0;
        $data['note'] = $message;

        $review_item = [
            'video_id' => $videoId,
            'reviewer_id' => $data['reviewer_id'],
            'review_time' => $data['review_time'],
            'review_status' => $data['review_status'],
            'note' => $data['note']
        ];

        $review->createNewReview($review_item);
        $data['status'] = 'ignore';


        return response()->json($data);
    }
}
