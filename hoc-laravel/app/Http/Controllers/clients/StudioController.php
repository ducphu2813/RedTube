<?php

namespace App\Http\Controllers\clients;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Video;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StudioController extends Controller
{
    public function index(){
        return view('studio.studioBase');
    }

    public function contents() {
        return view('studio.studioContents');
    }

    public function contentsVideos($pageNumber = 1, $itemPerPage = 10) {
        $userId = session('loggedInUser');
        $videos = Video::where('user_id', $userId)->skip(($pageNumber - 1) * $itemPerPage)->take($itemPerPage)->get();
        return view('studio.studioContentsVideos', ['videos' => $videos]);
    }

    public function contentsPlaylists($pageNumber = 1, $itemPerPage = 10) {
        $userId = session('loggedInUser');
        $playlists = Playlist::where('user_id', $userId)->skip(($pageNumber - 1) * $itemPerPage)->take($itemPerPage)->get();
        return view('studio.studioContentsPlaylists', ['playlists' => $playlists]);
    }

    public function videoDetails($video_id = null) {
        if ($video_id != null) {
            // $video = Video::where('video_id', $video_id)->get();
            $video = Cache::remember('video_' . $video_id, 0, function () use ($video_id) {
                return Video::find($video_id);
            });
            return view('studio.videoDetailsModal', ['video' => $video]);
        } else {
            return view('studio.videoDetailsModal');
        }
    }

    public function premium() {
        return view('studio.studioPremium');
    }

    public function profile() {
        return view('studio.studioProfile');
    }

    public function channel() {
        return view('studio.studioChannel');
    }
}
