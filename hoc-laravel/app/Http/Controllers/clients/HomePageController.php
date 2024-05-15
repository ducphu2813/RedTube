<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Playlist;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){

        $videos = Video::getAllVideo();

        $id = session('loggedInUser');

        $currentUserProfile = Users::getUserById($id);

        //lấy danh sách kênh mà user đang follow
        $followings = $currentUserProfile->following();

        return view('main.homePageBase',
            [
                'videos' => $videos,
                'currentUserProfile' => $currentUserProfile,
                'followings' => $followings
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
