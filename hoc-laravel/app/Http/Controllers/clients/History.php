<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class History extends Controller
{
    // Hàm hiển thị danh sách lịch sử xem
    public function showHistory(){
        return view('history.video-history-wrapper');
    }
}
