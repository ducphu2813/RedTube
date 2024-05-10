<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\History;
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


    // Hàm load video trang chủ
    public function reloadVideoList(){

        $videos = Video::getAllVideo();

        $id = session('loggedInUser');
        $currentUserProfile = Users::getUserById($id);


        return view('video.video-in-main-wrapper', ['videos' => $videos, 'currentUserProfile' => $currentUserProfile]);
    }

    // Hàm tìm kiếm
    public function searchVideo(){
        return view('video.video-search');
    }

}
