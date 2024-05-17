<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\PremiumPackage;
use App\Models\Category;
use App\Models\ShareNoti;
use App\Models\Membership;
use App\Models\Playlist;
use App\Models\Users;
use App\Models\Video;
use App\Models\VideoNotifications;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {

        $categories = Category::getAll();

        $videos = Video::getAllAvailableVideo();

        $userId = session('loggedInUser');

        $currentUserProfile = Users::getUserById($userId);

        if (!$currentUserProfile) {
            return view(
                'main.homePageBase',
                [
                    'videos' => $videos,
                    'currentUserProfile' => null,
                    'followings' => null
                ]
            );
        }

        //lấy danh sách kênh mà user đang follow
        $followings = $currentUserProfile->following();

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

        return view(
            'main.homePageBase',
            [
                'videos' => $videos,
                'currentUserProfile' => $currentUserProfile,
                'followings' => $followings,
                'notifications' => $notifications,
                'listCate' => $categories
            ]
        );
    }

    public function buyPremium(){

        //lấy tất cả gói premium
        $premiums = PremiumPackage::getAllPremiumPackages();

        return view('premium.privatePremiumBuy', ['premiums' => $premiums]);
    }

    public function userChannel()
    {
        $data = request()->all();
        $logged_user_id = session('loggedInUser');
        $user_id = $data['user_id'] ?? $logged_user_id;
        $user = Users::getUserById($user_id);
        $followers = $user->followersCount();
        $videoCounts = $user->videosCount();
        $isFollowing = $user->isFollowing($logged_user_id);

        $currentUserProfile = Users::getUserById(session('loggedInUser'));

        return view('main.userChannel',
            [
                'logged_user_id' => $logged_user_id,
                'user' => $user,
                'followers' => $followers,
                'videoCounts' => $videoCounts,
                'isFollowing' => $isFollowing
            ]
        );
    }

    public function userChannelVideos()
    {
        $data = request()->all();
        $user_id = $data['user_id'] ?? session('loggedInUser');
        $videos = Video::where('user_id', $user_id)->where('active', 1)->get();

        return view('video.video-in-main-wrapper', ['videos' => $videos]);
    }

    public function userChannelPlaylists() {
        $data = request()->all();
        $user_id = $data['user_id'] ?? session('loggedInUser');
        $playlists = Playlist::where('user_id', $user_id)->get();

        return view('playlist.playlist-all', ['userPlaylist' => $playlists]);
    }

    public function membershipModal() {
        $data = request()->all();
        $user_id = $data['user_id'] ?? session('loggedInUser');
        $memberships = Membership::where('user_id', $user_id)->get();

        return view('main.membershipModal', ['memberships' => $memberships]);
    }

    public function filterVideo(Request $request)
    {
        $data = $request->all();
        $category_ids = $data['category_ids'] ?? [];

        $listVideo = Video::getAllVideo();

        $arrayVideo = [];
        // Lọc video dựa trên danh mục (nếu có)
        if (isset($category_ids) && count($category_ids) > 0) {
            $listVideo = Video::getVideosByCategoryIds($category_ids, $listVideo);
        }

        foreach ($listVideo as $video) {
            $item = view('video.video-in-main-item', ['video' => $video])->render();
            array_push($arrayVideo, $item);
        }
        return response()->json($arrayVideo);
    }

    public function filterSearchVideo(Request $request)
    {
        $data = $request->all();
        $title = $data['keyword'] ?? '';
        $category_ids = $data['category_ids'] ?? [];
        $arrayVideo = [];

        if($title === ''){
            $listVideo = Video::getVideosByCategoryIds($category_ids, Video::getAllVideo());
            if(!isset($category_ids) || count($category_ids) == 0 || $category_ids == null || $category_ids == []){
                $listVideo = Video::getAllVideo();
            }
        }else{
            $listVideo = Video::searchVideo($title);


            // Lọc video dựa trên danh mục (nếu có)
            if (isset($category_ids) && count($category_ids) > 0) {
                $listVideo = Video::getVideosByCategoryIds($category_ids, $listVideo);
            }
        }
        foreach ($listVideo as $video) {
            $item = view('video.video-in-main-item', ['video' => $video])->render();
            array_push($arrayVideo, $item);
        }
        return response()->json($arrayVideo);
    }
}
