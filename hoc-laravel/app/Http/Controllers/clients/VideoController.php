<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller{


    public function index(){

    }

    public function videoDetail($id){
        $video = Cache::remember('video_' . $id, 0, function () use ($id) {
            return Video::find($id);
        });

        $id = session('loggedInUser');

        $playlists = Playlist::getPlaylistByUserId($id);

        return response()->json($video);

        // return view('video.video-detail', ['video' => $video, 'playlists' => $playlists]);

    }

    // Hàm phát video
    public function playVideo(){
        return view('video.play-video');
    }

    // Hàm load video trang chủ, đổ data là video mới nhất và random 
    public function reloadVideoList(){
        return view('video.video-in-main-wrapper');
    }

    // Hàm tìm kiếm
    public function searchVideo(){
        return view('video.video-search');
    }

    // Hàm xem video theo kênh đăng kí, đổ data là video theo kênh user đã đăng kí
    public function showVideoByChannel(){
        return view('video.video-in-main-wrapper');
    }
    
}
