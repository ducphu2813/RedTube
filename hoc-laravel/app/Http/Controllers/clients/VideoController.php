<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Playlist;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class VideoController extends Controller{


    public function index(){

    }

    public function videoDetail($id) {
        $video = Cache::remember('video_' . $id, 0, function () use ($id) {
            return Video::find($id);
        });

        $id = session('loggedInUser');

        $playlists = Playlist::getPlaylistByUserId($id);

//        return response()->json($video);

        return view('video.video-detail', ['video' => $video, 'playlists' => $playlists]);
    }

    public function get() {
        
    }

    public function create() {
        $data = request()->all();
        
        Video::create([
            'title' => $data['title'],
            'user_id' => session('loggedInUser'),
            'created_date' => now(),
            'view' => 0,
            'description' => $data['description'],
            'display_mode' => $data['display_mode'],
            'membership' => 0,
            'active' => 1,
            'video_path' => $data['video_path'],
            'thumbnail_path' => $data['thumbnail_path'],
            'is_approved' => 0
        ]);
    }

    public function edit() {
        $data = request()->all();
        $video_id = $data['video_id'];

        $video = Video::find($video_id);

        if ($video) {
            $video->title = $data['title'];
            $video->description = $data['description'];
            $video->display_mode = $data['display_mode'];
            $video->video_path = $data['video_path'];
            $video->thumbnail_path = $data['thumbnail_path'];

            $video->save();
        }
    }

    public function delete() {
        $data = request()->all();
        $video_id = $data['video_id'];

        $video = Video::find($video_id);

        if($video) {
            $video->active= 0;
            $video->save();
        }
    }

    public function playVideo($id, $playlist_id = null){

        $video = Cache::remember('video_' . $id, 0, function () use ($id) {
            return Video::find($id);
        });

        $videoModel = new Video();

        $userId = session('loggedInUser');

        //phần lưu lịch sử xem và tăng view
//        if($userId){
//            //lưu lịch sử xem video
//            $history = new History();
//            $history->createHistory(
//                [
//                    'user_id' => $userId,
//                    'video_id' => $id,
//                    'created_date' => date('Y-m-d H:i:s')
//                ]
//            );
//        }
//
//        //tăng view của video
//        $videoModel->increaseView($id);

        //playlist của user để cho chức năng thêm hoặc xóa video khỏi playlist
        $playlists = Playlist::getPlaylistByUserId($id);

        //lấy thông tin user đang đăng nhập
        $currentUserProfile = Users::getUserById($userId);

        //khi coi từ playlist
        if($playlist_id != null){

            //lấy playlist nếu bấm vào playlist
            $videoPlaylist = Playlist::find($playlist_id);

            //chỉ hiện playlist bên phải khi đủ 3 điều kiện:
            //1. Đã đăng nhập
            //2. Playlist đó là của user đang đăng nhập
            //3. Video đó có trong playlist đó
            if(($currentUserProfile && $currentUserProfile->user_id == $videoPlaylist->user_id  && $videoPlaylist->isVideoInPlaylist($id))){
                //lấy danh sách các video trong playlist đó
                $videosInPlayList = $videoPlaylist->getVideosInPlaylist();
                return view('video.play-video',
                    [
                        'video' => $video,
                        'playlists' => $playlists,
                        'currentUserProfile' => $currentUserProfile,
                        'videosInPlayList' => $videosInPlayList,
                        'videoPlaylist' => $videoPlaylist
                    ]
                );
            }

        }

        return view('video.play-video', ['video' => $video, 'playlists' => $playlists, 'currentUserProfile' => $currentUserProfile]);
    }


    // Hàm load video trang chủ, đổ data là video mới nhất và random 
    public function reloadVideoList(){
        $user_id = $data['user_id'] ?? session('loggedUser');
        $currentUserProfile = Users::getUserById($user_id);
        $videos = Video::where('active', 1)->get();

        return view('video.video-in-main-wrapper', ['videos' => $videos, 'currentUserProfile' => $currentUserProfile]);
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
