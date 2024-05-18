<?php

namespace App\Http\Controllers\clients;

use App\Models\Interaction;
use App\Models\PremiumRegistration;
use App\Models\SharePremium;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\History;
use App\Models\Playlist;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

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

    //hàm này để upload video và vừa để update video
    public function edit(Request $request) {
        $data = request()->all();

        $userId = session('loggedInUser');

        $video_id = $data['video_id'];

        $video = Video::find($video_id);

        $newVideoPath = null;
        $newThumbnailPath = null;

        //nếu video tồn tại thì lấy đường dẫn video và thumbnail cũ
        if($video){
            $newVideoPath = $video->video_path;
            $newThumbnailPath = $video->thumbnail_path;
        }

        if($request->hasFile('video_path')){
            //xóa video cũ
            if($video && $video->video_path){
                Storage::delete('public/video/' . $video->video_path);
            }
            //lấy file từ request
            $video_file = $request->file('video_path');
            //lấy extension của file
            $videoExtension = $video_file->getClientOriginalExtension();
            //tạo tên mới cho video
            $video_path_name =  time() . '.' . $videoExtension;
            //lưu đường dẫn video mới
            $newVideoPath = $video_path_name;
            //lưu video
            $video_file->storeAs('public/video/', $video_path_name);
        }

        if($request->hasFile('thumbnail_path')){

            //xóa thumbnail cũ
            if($video && $video->thumbnail_path){
                Storage::delete('public/thumbnail/' . $video->thumbnail_path);
            }
            //lấy file từ request
            $thumbnail_file = $request->file('thumbnail_path');
            //lấy extension của file
            $thumbnailExtension = $thumbnail_file->getClientOriginalExtension();
            //tạo tên mới cho thumbnail
            $thumbnail_path_name =  time() . '.' . $thumbnailExtension;
            //lưu đường dẫn thumbnail mới
            $newThumbnailPath = $thumbnail_path_name;
            //lưu thumbnail
            $thumbnail_file->storeAs('public/thumbnail/', $thumbnail_path_name);
        }

        $newVideo = [
            'video_id' => $data['video_id'],
            'title' => $data['title'],
            'user_id' => $userId,
            'description' => $data['description'],
            'display_mode' => $data['display_mode'],
            'membership' => $data['membership'],
            'video_path' => $newVideoPath,
            'thumbnail_path' => $newThumbnailPath,
        ];

        $videoModel = new Video();

        if($data['video_id']){
            $videoModel->updateVideo($video_id, $newVideo);
        }else{
            unset($newVideo['video_id']);
            $newVideo['created_date'] = date('Y-m-d H:i:s');
            $newVideo['active'] = 1;
            $newVideo['view'] = 0;
            $newVideo['membership'] = $data['membership'];

            //khi nào xong chức năng duyệt video thì sửa lại thành 0
//            $newVideo['is_approved'] = 0;
            $videoModel->createVideo($newVideo);
        }

        return response()->json($newVideo);
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

        $reaction = null;

        $interactionModel = new Interaction();

        if($userId){
            $reaction = $interactionModel->findInteraction($userId, $id);
        }

        //phần lưu lịch sử xem và tăng view
        if($userId){
            //lưu lịch sử xem video
            $history = new History();
            $history->createHistory(
                [
                    'user_id' => $userId,
                    'video_id' => $id,
                    'created_date' => date('Y-m-d H:i:s')
                ]
            );
        }

        //tăng view của video
        $videoModel->increaseView($id);

        //lấy danh sách video related
        $categoryIds = array_map(function($category) {
            return $category['category_id'];
        }, $video->getCategories()->get()->toArray());

//        dd($categoryIds);
        $relatedVideos = $videoModel->getRelatedVideos($categoryIds);

        //playlist của user để cho chức năng thêm hoặc xóa video khỏi playlist
        $playlists = Playlist::getPlaylistByUserId($userId);

        //lấy thông tin user đang đăng nhập
        $currentUserProfile = Users::getUserById($userId);
        $current_premium = null;
        $current_shared_premium = null;
        if($currentUserProfile){
            //lấy premium của user
            $current_premium = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

            //lấy premium đc share của user
            $current_shared_premium = SharePremium::getCurrentSharedPremiumByUser(session('loggedInUser'));
        }

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
                        'videoPlaylist' => $videoPlaylist,
                        'current_premium' => $current_premium,
                        'current_shared_premium' => $current_shared_premium,
                        'reaction' => $reaction,
                        'relatedVideos' => $relatedVideos
                    ]
                );
            }

        }

        return view('video.play-video',
            [
                'video' => $video,
                'playlists' => $playlists,
                'currentUserProfile' => $currentUserProfile,
                'current_premium' => $current_premium,
                'current_shared_premium' => $current_shared_premium,
                'reaction' => $reaction,
                'relatedVideos' => $relatedVideos
            ]
        );
    }


    // Hàm load video trang chủ
    public function reloadVideoList(){

        $videos = Video::getAllAvailableVideo();

        $listCate = Category::getAll();

        $id = session('loggedInUser');
        $currentUserProfile = Users::getUserById($id);

        return view('video.video-in-main-wrapper',
            [
                'videos' => $videos,
                'currentUserProfile' => $currentUserProfile,
                'listCate' => $listCate
            ]
        );
    }

    // Hàm tìm kiếm
    public function searchVideo(Request $request){

        $data = $request->all();

        $categories = Category::getAll();

        $videos = Video::searchVideo($data['searchValue']);
        return view('video.video-search', ['videos' => $videos, 'listCate' => $categories]);
    }

    // Hàm xem video theo kênh đăng kí, đổ data là video theo kênh user đã đăng kí
    public function showVideoByChannel(){
        return view('video.video-in-main-wrapper');
    }

}
