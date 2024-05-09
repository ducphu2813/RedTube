<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\PlaylistVideo;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{

    // public function index()
    // {
    // }

    // public function playlistDetail($id)
    // {
    // }

    // public function updateVideoPlaylist(Request $request)
    // {
    //     $playlistId = $request->input('playlist_id');
    //     $videoId = $request->input('video_id');
    //     $isChecked = $request->input('is_checked');

    //     $playlistVideo = new PlaylistVideo();

    //     //cần kiểm tra xem playlist_id và video_id có tồn tại không

    //     if ($isChecked == 'true') {
    //         if ($playlistVideo->addVideoToPlaylist($playlistId, $videoId)) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Thêm video vào playlist thành công'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
    //             ]);
    //         }
    //     } else {
    //         if ($playlistVideo->removeVideoFromPlaylist($playlistId, $videoId)) {
    //             return response()->json([
    //                 'status' => 200,
    //                 'message' => 'Xóa video khỏi playlist thành công'
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
    //             ]);
    //         }
    //     }
    // }

    // Hiển thị danh sách xem sau (nó cũng là 1 danh sách phát, nhưng không được xóa)
    public function showWatchLater(){
        return view('playlist.later-playlist');
    }

    // Tạo danh sách phát
    public function showCreatePlaylist()
    {
        return view('playlist.playlistModal');
    }

    // Hiển thị danh sách phát
    public function showAllPlaylist()
    {
        return view('playlist.playlist-all');
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
