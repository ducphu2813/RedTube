<?php

namespace App\Http\Controllers\clients;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Video;
use App\Models\Users;

use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StudioController extends Controller
{
    public function index(){
        return view('studio.studioBase');
    }

    public function contents() {
        return view('studio.studioContents');
    }

    public function contentsVideos(Request $request) {
        $data = request()->all();
        $currentPage = $data['currentPage'] ?? 1; 
        $itemPerPage = $data['itemPerPage'] ?? 1;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $userId = session('loggedInUser');
        $videos = Video::where('user_id', $userId)->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItems = Video::where('user_id', $userId)->count();

        $totalPages = ceil($totalItems / $itemPerPage);
        if($currentPage > $totalPages) {
            return view('');
        }

        return view('studio.studioContentsVideos', ['videos' => $videos, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'pageDisplay' => $pageDisplay]);
    }

    public function contentsPlaylists($pageNumber = 1, $itemPerPage = 1) {
        $userId = session('loggedInUser');
        $playlists = Playlist::where('user_id', $userId)->skip(($pageNumber - 1) * $itemPerPage)->take($itemPerPage)->get();
        return view('studio.studioContentsPlaylists', ['playlists' => $playlists]);
    }

    public function videoDetails($video_id = null) {
        $video = null;
        if ($video_id !== null) {
            $video = Cache::remember('video_' . $video_id, 0, function () use ($video_id) {
                return Video::find($video_id);
            });
        }

        return view('studio.videoDetailsModal', ['video' => $video]);
    }

    public function pagination(Request $request) {
        $data = request()->all();
        $totalPages = $data['totalPages'];
        $currentPage = $data['currentPage'] ?? 1; 
        $pageDisplay = $data['pageDisplay'] ?? 3;

        return view('studio.pagination', ['totalPages' => $totalPages, 'currentPage' => $currentPage, 'pageDisplay' => $pageDisplay]);
    }

    public function premium() {
        return view('studio.studioPremium');
    }

    public function profile() {
        $user = Users::find(session('loggedInUser'));
        return view('studio.studioProfile', ['user' => $user]);
    }

    public function channel() {
        return view('studio.studioChannel');
    }

    // Show all noti
    public function showAllNoti(){
        return view('noti.noti-all');
    }
}
