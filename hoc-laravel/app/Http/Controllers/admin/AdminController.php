<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumRegistration;
use App\Models\Category;
use App\Models\ReviewHistory;
use App\Models\Users;
use App\Models\Video;
use App\Models\VideoCategory;
use App\Models\VideoNotifications;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // hàm hiển thị trang danh sách tất cả video
    public function showVideoList()
    {
        $data = request()->all();
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $videos = Video::whereNotNull('is_approved')->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItem = Video::whereNotNull('is_approved')->count();
        $totalPages = ceil($totalItem / $itemPerPage);

        $listCate = Category::getAll();
        return view('admin.videoWrapper', [
            // 'listVideo' => $listVideo,
            'listCate' => $listCate,
            'listVideo' => $videos,
            'currentPage' => $currentPage,
            'itemPerPage' => $itemPerPage,
            'pageDisplay' => $pageDisplay,
            'totalPages' => $totalPages
        ]);
    }

    // tim kiem có bộ lọc
    public function filterVideoList(Request $request)
    {
        $data = $request->all();
        $choice = $data['is_approved'] ?? null;
        $category_ids = $data['category_ids'] ?? [];
        $searchKeyword = $data['keyword'] ?? '';

        $arrayVideo = [];

        // Lấy danh sách video dựa trên trạng thái phê duyệt
        if ($choice == 1) {
            $listVideo = Video::getAllVideoIsApproved();
        } else if ($choice == 2) {
            $listVideo = Video::getVideoAccept();
        } else {
            $listVideo = Video::getVideoDeny();
        }

        // Lọc video dựa trên danh mục (nếu có)
        if (isset($category_ids) && count($category_ids) > 0) {
            $listVideo = Video::getVideosByCategoryIds($category_ids, $listVideo);
        }

        // Lọc video dựa trên từ khóa tìm kiếm
        if (!empty($searchKeyword)) {
            $videoOb = new Video();
            $listVideo = $videoOb->getVideosByNameSimilarity($listVideo, $searchKeyword);
        }

        // Tạo mảng HTML cho danh sách video
        foreach ($listVideo as $video) {
            $item = view('admin.videoItem', ['video' => $video])->render();
            array_push($arrayVideo, $item);
        }

        return response()->json($arrayVideo);
    }

    // filter user
    public function filterUserList(Request $request){
        $data = $request->all();
        $role = $data['role'] ?? null;
        $active = $data['is_active'] ?? null;
        $user_name = $data['keyword'] ?? '';

        $arrayUser = [];

        if($role == 1){
            $listUser = Users::getAllUsers();
        } else if($role == 2){
            $listUser = Users::getUsers();
        } else if($role == 3){
            $listUser = Users::getUsersReviewer();
        }else{
            $listUser = Users::getUsersAdmin();
        }

        if($active == 1){
            // $listUser = Users::getAllUsers();
        } else if($active == 2){
            $User = new Users();
            $listUser = $User->getActiveUsersFromList($listUser);
        }else{
            $User = new Users();
            $listUser = $User->getInactiveUsersFromList($listUser);
        }

        if(!empty($user_name)){
            $User = new Users();
            $listUser = $User->getUsersByNameSimilarity($listUser, $user_name);
        }

        foreach($listUser as $user){
            $item = view('admin.userItem', ['user' => $user])->render();
            array_push($arrayUser, $item);
        }

        return response()->json($arrayUser);
    }

    public function searchVideo(Request $request)
    {
        $data = $request->all();
        $choice = $data['is_approved'] ?? null;
        $category_ids = $data['category_ids'] ?? [];

        $title = $data['title'];
        $listVideo = Video::searchVideo($title);
        $listCate = Category::getAll();
        return view('admin.videoWrapper', ['listVideo' => $listVideo, 'listCate' => $listCate]);
    }


    // hàm hiển thị trang danh sách user
    public function showUserList()
    {
        $listUser = Cache::remember('list_user', 0, function () {
            return Users::getAllUsers();
        });
        return view('admin.userWrapper', ['listUser' => $listUser]);
    }

    // hàm hiển thị trang danh sách đã check
    public function showVideoIsApproved()
    {
        $listVideo = Cache::remember('list_video', 0, function () {
            return Video::getVideoAccept();
        });
        $listCate = Category::getAll();
        return view('admin.videoWrapper', ['listVideo' => $listVideo, 'listCate' => $listCate]);
    }

    // hàm hiển thị trang danh sách chưa check
    public function showCheckList()
    {
        $videoNotApproved = Video::getAllVideoIsNotApproved();
        return view('admin.checkWrapper', ['listCheck' => $videoNotApproved]);
    }

    public function showReviewHistoryList()
    {
        $reviewList = ReviewHistory::getAllReviewHistory();
        return view('admin.reviewHistory', ['reviewList' => $reviewList]);
    }

    // hàm hiển thị trang quản lý
    public function showAll()
    {
        return view('admin.layout');
    }

    // User
    // hàm thay đổi trạng thái user
    public function changeRoleUser(Request $request)
    {
        $data = $request->all();
        $id = $data['user_id'];
        $role = $data['role'];
        $user = new Users();
        $user->updateUser($id, ['role' => $role]);
    }

    // hàm khóa hoặc mở khóa user
    public function changeStatusUser(Request $request)
    {
        $data = $request->all();
        $id = $data['user_id'];
        $active = $data['active'] :: null;
        if($active === null){
            return response()->json(['message' => 'Thao tác đã bị hủy!']);
        }
        $user = new Users();
        $user->updateUser($id, ['active' => $active]);
    }

    // Video
    // hàm khóa hoặc mở khóa video
    public function changeStatusVideo(Request $request)
    {
        $data = $request->all();
        $id = $data['video_id'];
        $is_approved = $data['is_approved'];
        $video = new Video();
        $video->updateVideo($id, ['is_approved' => $is_approved]);

        $reviewModel = new ReviewHistory();

        $review_item = [
            'video_id' => $video->video_id,
            'reviewer_id' => $data['reviewer_id'],
            'review_time' => date('Y-m-d H:i:s'),
            'review_status' => 0,
            'note' => 'Video của bạn đã bị khóa'
        ];

        // Lưu vào bảng review
        $reviewModel->createNewReview($review_item);
    }

    // Check video
    // hàm duyệt video
    public function showCheckModal(Request $request)
    {
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
    public function showCheckModalIgnore(Request $request)
    {
        $data = $request->all();
        $video = Video::getVideoById($data['video_id']);
        $data['video'] = $video;
        return view('admin.checkIsNotApproved', $data);
    }

    // Analysis data
    public function showChartList(){

        return view('admin.chartWrapper');
    }

    // hàm lấy dữ liệu cho biểu đồ
    public function getChartData(Request $request){
        $data = $request->all();
        $year = $data['year'];

        unset($data['_token']);

        //lấy dữ liệu thống kê lượt đăng ký mới user
        $data['newUser'] = Users::getUserRegistrationStatsByYear($year);

        //lấy dữ liệu tiền thu được từ các gói premium
        $data['revenue'] = PremiumRegistration::getPremiumRevenueStatsByYear($year);

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    // Category add to video
    public function acceptVideo(Request $request)
    {
        $catevideo = new VideoCategory();
        $review = new ReviewHistory();
        $data = $request->all();
        $videoId = $data['video_id'];
        $categoryIds = $data['category_ids'];

        // Lưu vào bảng videoCategory
        foreach ($categoryIds as $categoryId) {
            $catevideo->addCategoryToVideo($videoId, $categoryId);
        }

        // Gom data review, lưu về bảng review
        $data['reviewer_id'] = $request->session()->get('loggedInUser');
        $data['review_time'] = date('Y-m-d H:i:s');
        $data['review_status'] = 1;
        $data['note'] = 'Video của bạn đã được duyệt';
        $review_item = [
            'video_id' => $videoId,
            'reviewer_id' => $data['reviewer_id'],
            'review_time' => $data['review_time'],
            'review_status' => $data['review_status'],
            'note' => $data['note']
        ];

        // Lưu vào bảng review
        $review->createNewReview($review_item);
        $data['status'] = 'accept';

        // Kiểm tra xem video đã được duyệt, cho ra public
        $video = Video::getVideoById($videoId);
        if ($video) {
            $video->is_approved = 1;
            $video->save();
        }

        // Gom data thông báo, luu vào bảng thông báo
        $noti['user_id'] = $video->user_id;
        $noti['video_id'] = $videoId;
        $noti['created_date'] = $data['review_time'];
        $noti['message'] = $data['note'];
        $noti['is_read'] = 0;

        // Lưu thông báo vào bảng thông báo
        $notification = new VideoNotifications();
        $notification::createNewNotification($noti);

        return response()->json($data);
    }

    // hàm không duyệt video
    public function ignoreVideo(Request $request)
    {
        $review = new ReviewHistory();
        $video = new Video();
        $data = $request->all();
        $videoId = $data['video_id'];
        $message = $data['note'];
        $video = Video::getVideoById($videoId);

        $data['reviewer_id'] = $request->session()->get('loggedInUser');
        $data['review_status'] = 0;
        $data['note'] = 'Bởi vì: ' . $message . ', video bị từ chối vào lúc';

        $review_item = [
            'video_id' => $videoId,
            'reviewer_id' => $data['reviewer_id'],
            'review_time' => date('Y-m-d H:i:s'),
            'review_status' => $data['review_status'],
            'note' => $data['note']
        ];

        $review->createNewReview($review_item);
        $data['status'] = 'ignore';

        if ($video) {
            $video->is_approved = 0;
            $video->save();
        }

        $noti['user_id'] = $video->user_id;
        $noti['video_id'] = $videoId;
        $noti['created_date'] = date('Y-m-d H:i:s');
        $noti['message'] = $data['note'];
        $noti['is_read'] = 0;
        $notification = new VideoNotifications();
        $notification::createNewNotification($noti);


        return response()->json($data);
    }
}
