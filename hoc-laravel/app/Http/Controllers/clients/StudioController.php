<?php

namespace App\Http\Controllers\clients;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use App\Models\Video;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StudioController extends Controller
{
    public function index(){

        $data = [
            'user' => Users::getUserById(session('loggedInUser')),
        ];

        return view('studio.studioBase', $data);
    }

    public function contents() {
        return view('studio.studioContents');
    }

    public function contentsVideos() {
        $data = request()->all();
        $currentPage = $data['currentPage'] ?? 1; 
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $userId = session('loggedInUser');
        $videos = Video::where('user_id', $userId)->where('active', 1)->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItems = Video::where('user_id', $userId)->where('active', 1)->count();

        $totalPages = ceil($totalItems / $itemPerPage);
        if($currentPage > $totalPages) {
            return view('');
        }

        return view('studio.studioContentsVideos', ['videos' => $videos, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'pageDisplay' => $pageDisplay]);
    }

    public function contentsPlaylists() {
        $data = request()->all();
        $currentPage = $data['currentPage'] ?? 1; 
        $itemPerPage = $data['itemPerPage'] ?? 10;
        $pageDisplay = $data['pageDisplay'] ?? 3;

        $userId = session('loggedInUser');
        $playlists = Playlist::where('user_id', $userId)->skip(($currentPage - 1) * $itemPerPage)->take($itemPerPage)->get();
        $totalItems = Playlist::where('user_id', $userId)->count();

        $totalPages = ceil($totalItems / $itemPerPage);
        if($currentPage > $totalPages) {
            return view('');
        }

        return view('studio.studioContentsPlaylists', ['playlists' => $playlists, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'pageDisplay' => $pageDisplay]);
    }

    public function videoDetails() {
        $data = request()->all();
        $video_id = $data['video_id'] ?? null; 
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10;

        if ($video_id) {
            $video = Video::find($video_id);
            return view('studio.videoDetailsModal', ['video' => $video, 'currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'flag' => 'edit']);
        }

        return view('studio.videoDetailsModal', ['currentPage' => $currentPage, 'itemPerPage' => $itemPerPage, 'flag' => 'add']);
    }

    public function pagination() {
        $data = request()->all();
        $url = $data['url'];
        $totalPages = $data['totalPages'];
        $currentPage = $data['currentPage'] ?? 1;
        $itemPerPage = $data['itemPerPage'] ?? 10; 
        $pageDisplay = $data['pageDisplay'] ?? 3;

        return view('studio.pagination', ['totalPages' => $totalPages, 'itemPerPage' => $itemPerPage, 'currentPage' => $currentPage, 'pageDisplay' => $pageDisplay, 'url' => $url]);
    }

    public function premium() {
        return view('studio.studioPremium');
    }


    public function profile(Request $request) {

        $data = [
            'user' => Users::getUserById(session('loggedInUser')),
        ];

        return view('studio.studioProfile', $data);
    }

    
    public function profileEdit(Request $request) {

        if(!session('loggedInUser')){
            return response()->json([
                'status' => 401,
                'message' => 'Bạn cần đăng nhập để thực hiện hành động này',
            ]);
        }

        $data = $request->all();
        $user = Users::getUserById(session('loggedInUser'));
        unset($data['_token']);

        //kiểm tra xem có thay đổi ảnh hay không
        if($request->hasFile('picture_url') && isset($data['picture_url'])){
            $file = $request->file('picture_url');
            $fileName = time() . $file->getClientOriginalName();
            $file->storeAs('public/img/', $fileName);

            if($user->picture_url){
                Storage::delete('public/img/' . $user->picture_url);
                $user->picture_url = $fileName;
            }
            $data['picture_url_status'] = 'isChange';
            $data['new_picture_url'] = $fileName;
        }

        $newUserData = [
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'description' => $data['description'],
            'channel_name' => $data['channel_name'],
            'picture_url' => $user->picture_url,
        ];

        $userModel = new Users;

        $userModel->updateUser($user->user_id, $newUserData);

        $data['status'] = 'success';
        $data['message'] = 'Cập nhật thông tin thành công';

        return response()->json($data);

    }

    public function channel() {
        return view('studio.studioChannel');
    }
}
