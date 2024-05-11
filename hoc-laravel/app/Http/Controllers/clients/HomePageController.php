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
}
