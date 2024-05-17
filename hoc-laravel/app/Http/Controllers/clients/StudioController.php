<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\PaymentHistory;
use App\Models\Playlist;
use App\Models\ShareNoti;
use App\Models\UserMembership;
use App\Models\PremiumRegistration;
use App\Models\Users;
use App\Models\VideoNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use App\Models\Video;

use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StudioController extends Controller
{
    public function index()
    {

        $data = [
            'user' => Users::getUserById(session('loggedInUser')),
        ];

        return view('studio.studioBase', $data);
    }

    public function contents()
    {
        return view('studio.studioContents');
    }

    public function contentsVideos(Request $request)
    {
        $data = request()->all();
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $userId = session('loggedInUser');
        $videos = Video::where('user_id', $userId)->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItems = Video::where('user_id', $userId)->where('active', 1)->count();

        $totalPages = ceil($totalItems / $itemPerPage);
        if ($currentPage > $totalPages) {
            return view('');
        }

        return view('studio.studioContentsVideos', ['videos' => $videos, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'pageDisplay' => $pageDisplay]);
    }

    public function contentsPlaylists()
    {
        $data = request()->all();
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $userId = session('loggedInUser');
        $playlists = Playlist::where('user_id', $userId)->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItems = Playlist::where('user_id', $userId)->count();

        $totalPages = ceil($totalItems / $itemPerPage);
        if ($currentPage > $totalPages) {
            return view('');
        }

        return view('studio.studioContentsPlaylists', ['playlists' => $playlists, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'pageDisplay' => $pageDisplay]);
    }

    public function videoDetails()
    {
        $data = request()->all();
        $video_id = $data['video_id'] ?? null;
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;

        if ($video_id) {
            $video = Video::find($video_id);
            return view('studio.videoDetailsModal', ['video' => $video, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'flag' => 'edit']);
        }

        return view('studio.videoDetailsModal', ['video' => null, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'flag' => 'add']);
    }

    public function pagination(Request $request)
    {
        $data = request()->all();
        $url = $data['url'];
        $totalPages = $data['totalPages'];
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        return view('studio.pagination', ['totalPages' => $totalPages, 'itemPerPage' => $itemPerPage, 'currentPage' => $currentPage, 'pageDisplay' => $pageDisplay, 'url' => $url]);
    }

    public function premium()
    {
        return view('studio.studioPremium');
    }


    public function profile(Request $request)
    {

        $user = Users::getUserById(session('loggedInUser'));

        $data = [
            'user' => $user,
        ];

        //lấy tổng số video của user
        $data['totalVideos'] = $user->videoCount();

        //lấy tổng số view của user
        $data['totalViews'] = $user->totalView();

        //lấy tổng follow của user
        $data['totalFollow'] = $user->totalFollow();

        //lấy tổng lượt like của user
        $data['totalLikes'] = $user->totalLikes();

        return view('studio.studioProfile', $data);
    }

    // lich su giao dich
    public function transactionHistory() {

        $payments = PaymentHistory::getPaymentHistoryByUserId(session('loggedInUser'));


        return view('studio.studioTransactionHistory', ['payments' => $payments]);
    }

    //modal lich su giao dich
    public function transactionDetails(Request $request){

        $data = $request->all();

        unset($data['_token']);

        $payment = PaymentHistory::getPaymentHistoryByPaymentId($data['payment_id']);

        return view('studio.transactionDetailsModal', ['payment' => $payment]);
    }


    public function profileEdit(Request $request)
    {

        if (!session('loggedInUser')) {
            return response()->json([
                'status' => 401,
                'message' => 'Bạn cần đăng nhập để thực hiện hành động này',
            ]);
        }

        $data = $request->all();
        $user = Users::getUserById(session('loggedInUser'));
        unset($data['_token']);

        //        $newUserData = [];
        $userModel = new Users;

        //kiểm tra xem có thay đổi ảnh hay không
        if ($request->hasFile('picture_url') && isset($data['picture_url'])) {
            $file = $request->file('picture_url');
            $fileName = time() . $file->getClientOriginalName();
            $file->storeAs('public/img/', $fileName);

            if ($user->picture_url) {
                Storage::delete('public/img/' . $user->picture_url);
                $user->picture_url = $fileName;
            }
            $data['picture_url_status'] = 'isChange';
            $data['new_picture_url'] = $fileName;
            //            $newUserData['picture_url'] = $fileName;
            $newUserData = [
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'description' => $data['description'],
                'channel_name' => $data['channel_name'],
                'picture_url' => $fileName,
            ];

            $userModel->updateUser($user->user_id, $newUserData);
        } else {
            $newUserData = [
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'description' => $data['description'],
                'channel_name' => $data['channel_name'],
            ];


            $userModel->updateUser($user->user_id, $newUserData);
        }



        $data['status'] = 'success';
        $data['message'] = 'Cập nhật thông tin thành công';

        return response()->json($data);
    }

    public function channel()
    {
        return view('studio.studioChannel');
    }

    // Show all noti
    public function showAllNoti(){

        $userId = session('loggedInUser');

        //lấy tất cả thông báo của user về video
        $videoNotis = VideoNotifications::getNotificationByUserId($userId)->toArray();
        foreach ($videoNotis as &$noti) {
            $noti['type'] = 'video';
            $noti['video_title'] = Video::getVideoById($noti['video_id'])->title;
//            $noti['created_date'] = $noti['created_date']->format('Y-m-d H:i:s');
        }

        //lấy tất cả thông báo chia sẻ của user
        $shareNotis = ShareNoti::getNotiByReceiver($userId)->toArray();
        foreach ($shareNotis as &$noti) {
            $noti['type'] = 'share';
            $noti['sender_name'] = Users::getUserById($noti['sender_id'])->user_name;
//            $noti['created_date'] = $noti['created_date']->format('Y-m-d H:i:s');
        }

        //gộp 2 mảng lại với nhau và sắp xếp theo created_date
        $notifications = array_merge($videoNotis, $shareNotis);

        usort($notifications, function ($a, $b) {
            return strtotime($b['created_date']) - strtotime($a['created_date']);
        });

        return view('noti.noti-all', ['notifications' => $notifications]);
    }

    public function test()
    {
        session()->flash('flag', 'noti');

        return redirect()->route('clients.studioPage');
    }

    public function analysis()
    {
        return view('studio.studioAnalysis');
    }

    public function getAnalysisByYear(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        $userId = session('loggedInUser');

        $year = $data['year'];

        //lấy dữ liệu thống kê lượt đăng ký theo từng tháng của user
        $data['followStats'] = Follow::getFollowStatsByYear($year, $userId);

        //lấy dữ liệu thống kê của membership
        $data['membershipStats'] = UserMembership::getMembershipStatsByYear($year, $userId);

        return response()->json([
            'status' => 200,
            'message' => 'Lấy dữ liệu thành công',
            'data' => $data,
        ]);
    }
}
