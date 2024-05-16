<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Playlistplaylist;
use App\Models\PlaylistVideo;
use App\Models\Users;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{

    // public function index()
    // {
    // }

    // public function playlistDetail($id)
    // {
    // }

    // public function updateplaylistPlaylist(Request $request)
    // {
    //     $playlistId = $request->input('playlist_id');
    //     $playlistId = $request->input('playlist_id');
    //     $isChecked = $request->input('is_checked');

    //     $playlistplaylist = new Playlistplaylist();

    //     //cần kiểm tra xem playlist_id và playlist_id có tồn tại không

    //     if ($isChecked == 'true') {
    //         if ($playlistplaylist->addplaylistToPlaylist($playlistId, $playlistId)) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Thêm playlist vào playlist thành công'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
    //             ]);
    //         }
    //     } else {
    //         if ($playlistplaylist->removeplaylistFromPlaylist($playlistId, $playlistId)) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Xóa playlist khỏi playlist thành công'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
    //             ]);
    //         }
    //     }
    // }

    public function get() {

    }

    public function create() {
        $data = request()->all();

        Playlist::create([
            'user_id' => session('loggedInUser'),
            'name' => $data['name'],
            'created_date' => now(),
        ]);
    }

    public function edit() {
        $data = request()->all();
        $playlist_id = $data['playlist_id'];

        $playlist = Playlist::find($playlist_id);

        if ($playlist) {
            $playlist->name = $data['name'];

            $playlist->save();
        }
    }

    public function delete() {
        $data = request()->all();
        $playlist_id = $data['playlist_id'];

        $playlist = Playlist::find($playlist_id);

        if($playlist) {
            PlaylistVideo::deleteAllFromPlaylist($playlist_id);
            $playlist->delete();
        }
    }

    // Hiển thị danh sách xem sau (nó cũng là 1 danh sách phát, nhưng không được xóa)
    public function showWatchLater(){

        //xử lý khi chưa login
        if(session('loggedInUser') == null){
            return view('playlist.login-noti');
        }

        $user = Users::getUserById(session('loggedInUser'));

        $watchLaterVideo = Playlist::getVideosInWatchLaterPlaylist($user->user_id);

//        dd($watchLaterVideo);

        return view('playlist.later-playlist', ['watchLaterVideo' => $watchLaterVideo]);
    }

    // Tạo danh sách phát
    public function playlistDetails()
    {
        $data = request()->all();
        $playlist_id = $data['playlist_id'] ?? null;
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;

        if ($playlist_id) {
            $playlist = Playlist::find($playlist_id);
            return view('playlist.playlistModal', ['playlist' => $playlist, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'flag' => 'edit']);
        }

        return view('playlist.playlistModal', ['currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'flag' => 'add']);
    }

    // Hiển thị danh sách phát trên trang chủ
    public function showAllPlaylist()
    {
        //xử lý khi chưa login
        if(session('loggedInUser') == null){
            return view('playlist.login-noti');
        }

        $userPlaylist = Playlist::getPlaylistByUserId(session('loggedInUser'));

        return view('playlist.playlist-all', ['userPlaylist' => $userPlaylist]);
    }

    public function playlistDetail($id){

    }

    public function updateVideoPlaylist(Request $request){

        $playlistId = $request->input('playlist_id');
        $videoId = $request->input('video_id');
        $isChecked = $request->input('is_checked');

        $playlistVideo = new PlaylistVideo();

        //cần kiểm tra xem playlist_id và video_id có tồn tại không

        if($isChecked == 'true'){
            if($playlistVideo->addVideoToPlaylist($playlistId, $videoId)){
                return response()->json([
                    'status' => 200,
                    'message' => 'Thêm video vào playlist thành công'
                ]);
            }
            else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
                ]);
            }


        }
        else{
            if($playlistVideo->removeVideoFromPlaylist($playlistId, $videoId)){
                return response()->json([
                    'status' => 200,
                    'message' => 'Xóa video khỏi playlist thành công'
                ]);
            }
            else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
                ]);
            }
        }

        //cái này để debug
//        return response()->json([
//            'playlist_id' => $playlistId,
//            'video_id' => $videoId,
//            'is_checked' => $isChecked
//        ]);
    }
}
