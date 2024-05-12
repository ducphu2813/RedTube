<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){

        $videos = Video::getAllVideo();

        $id = session('loggedInUser');

        $currentUserProfile = Users::getUserById($id);
        $channels = $currentUserProfile->getUsersByFollowing();

        return view('main.homePageBase', ['videos' => $videos, 'currentUserProfile' => $currentUserProfile, 'channels' => $channels]);  
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
        $user_id = $data['user_id'] ?? session('loggedUser');
        $videos = Video::getVideoByUserId($user_id);

        return view('video.video-in-main-wrapper', ['videos' => $videos]);
    }

    public function userChannelPlaylists() {

    }
    
}
