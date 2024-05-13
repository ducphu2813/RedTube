<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Playlist;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller {
    static function doMessage() {
        $data = request()->all();
        $title = $data['title'] ?? "Cảnh báo"; 
        $message = $data['message'] ?? "";

        $url = $data['url'] ?? "";
        $type = $data['type'];
        $dataType = $data['dataType'];

        return view('clients.message', ['title' => $title, 'message' => $message, 'url' => $url, 'type' => $type, 'dataType' => $dataType]);
    }
}