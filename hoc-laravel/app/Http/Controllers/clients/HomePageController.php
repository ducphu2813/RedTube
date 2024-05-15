<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\ShareNoti;
use App\Models\Membership;
use App\Models\Playlist;
use App\Models\Users;
use App\Models\Video;
use App\Models\VideoNotifications;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){

        $videos = Video::getAllVideo();

        $userId = session('loggedInUser');

        $currentUserProfile = Users::getUserById($userId);

        if(!$currentUserProfile){
            return view('main.homePageBase',
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

        return view('main.homePageBase',
            [
                'videos' => $videos,
                'currentUserProfile' => $currentUserProfile,
                'followings' => $followings,
                'notifications' => $notifications,
            ]
        );
    }

    public function buyPremium(){
        return view('premium.privatePremiumBuy');
    }

    public function userChannel() {
        $data = request()->all();
        $logged_user_id = session('loggedInUser');
        $user_id = $data['user_id'] ?? $logged_user_id;
        $user = Users::getUserById($user_id);
        $followers = $user->followersCount();
        $videoCounts = $user->videosCount();
        $isFollowing = $user->isFollowing($logged_user_id);

        return view('main.userChannel', ['logged_user_id' => $logged_user_id, 'user' => $user, 'followers' => $followers, 'videoCounts' => $videoCounts, 'isFollowing' => $isFollowing]);
    }

    public function userChannelVideos() {
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

}
