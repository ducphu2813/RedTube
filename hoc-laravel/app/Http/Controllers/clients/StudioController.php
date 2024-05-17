<?php

namespace App\Http\Controllers\clients;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PremiumRegistration;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        $videos = Video::query()
            ->leftJoin('comment', 'video.video_id', '=', 'comment.video_id')
            ->leftJoin('interaction', function ($join) {
                $join->on('video.video_id', '=', 'interaction.video_id')
                    ->where('interaction.reaction', '=', 1);
            })
            ->select('video.*',
                DB::raw('COUNT(DISTINCT comment.comment_id) as comment'),
                DB::raw('COUNT(DISTINCT interaction.video_id, interaction.user_id) as likes')
            )
            ->where('video.active', 1)
            ->groupBy('video.video_id')
            ->skip(($currentPage - 1) * $itemPerPage)
            ->take($itemPerPage)
            ->get();
    

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
        $playlists = Playlist::query()
            ->select('playlist.*', DB::raw('COUNT(CASE WHEN video.active = 1 THEN playlist_video.video_id END) as count'))
            ->leftJoin('playlist_video', 'playlist.playlist_id', '=', 'playlist_video.playlist_id')
            ->leftJoin('video', 'playlist_video.video_id', '=', 'video.video_id')
            ->groupBy('playlist.playlist_id')
            ->skip(($currentPage - 1) * $itemPerPage)
            ->take($itemPerPage)
            ->get();

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

        // $user = Users::getUserById(session('loggedInUser'));
        $user = Users::query()
            ->select('users.*',
                DB::raw('(SELECT COUNT(*) FROM video WHERE video.user_id = users.user_id AND video.active = 1) AS videos'),
                DB::raw('(SELECT COUNT(*) FROM history WHERE history.user_id = users.user_id) AS views'),
                DB::raw('(SELECT COUNT(*) FROM interaction WHERE interaction.user_id = users.user_id AND interaction.reaction = 1) AS likes'),
                DB::raw('(SELECT COUNT(*) FROM follow WHERE follow.user_id = users.user_id) AS subscribers')
            )
            ->where('users.user_id', session('loggedInUser'))
            ->first();

        return view('studio.studioProfile', ['user' => $user]);
    }

    // lich su giao dich
    public function transactionHistory() {
        $transactions = PremiumRegistration::with('premiumPackage')->where('user_id', session("LoggedInUser"))->get();
        return view('studio.studioTransactionHistory', ['transactions' => $transactions]);
    }

    //modal lich su giao dich
    public function transactionDetails() {
        return view('studio.transactionDetailsModal');
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
