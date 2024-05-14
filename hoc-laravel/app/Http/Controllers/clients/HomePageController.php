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
        $url = $data['url'];
        $currentPage = $data['currentPage'] ?? 1; 
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $user_id = $data['user_id'] ?? session('loggedUser');
        $videos = Video::where('user_id', $user_id)->where('active', 1)->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItems = Video::where('user_id', $user_id)->where('active', 1)->count();

        $totalPages = ceil($totalItems / $itemPerPage);
        if($currentPage > $totalPages) {
            return view('');
        }

        return view('video.video-in-main-wrapper', ['videos' => $videos, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'pageDisplay' => $pageDisplay, 'url' => $url]);
    }

    public function userChannelPlaylists() {

    }
    
}
