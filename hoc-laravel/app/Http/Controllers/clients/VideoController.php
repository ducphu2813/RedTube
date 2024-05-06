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

        $video = Cache::remember('video_' . $id, 60, function () use ($id) {
            return Video::find($id);
        });

        $id = session('loggedInUser');

        $playlists = Playlist::getPlaylistByUserId($id);

//        return response()->json($video);

        return view('video.video-detail', ['video' => $video, 'playlists' => $playlists]);

    }

    public function playVideo(){
        return view('video.play-video');
    }
}
