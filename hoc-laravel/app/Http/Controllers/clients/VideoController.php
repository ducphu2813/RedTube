<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Users;
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

//        return response()->json($video);

        return view('video.video-detail', ['video' => $video, 'playlists' => $playlists]);

    }

    public function playVideo($id){

        $video = Cache::remember('video_' . $id, 0, function () use ($id) {
            return Video::find($id);
        });

        $id = session('loggedInUser');

        $playlists = Playlist::getPlaylistByUserId($id);

        $currentUserProfile = Users::getUserById($id);

        return view('video.play-video', ['video' => $video, 'playlists' => $playlists, 'currentUserProfile' => $currentUserProfile]);
    }

}
