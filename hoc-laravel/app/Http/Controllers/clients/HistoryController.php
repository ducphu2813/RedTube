<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // Hàm hiển thị danh sách lịch sử xem
    public function showHistory(){

        //xử lý khi chưa login
        if(session('loggedInUser') == null){
            return view('playlist.login-noti');
        }

        $historyModel = new History();

        $userId = session('loggedInUser');

        $histories = $historyModel->getHistoryByUserId($userId);

        $groupedHistories = $histories->sortByDesc('created_date')->groupBy(function($item) {
            return $item->created_date->format('d/m/Y');
        });

//        dd($groupedHistories);

        return view('history.video-history-wrapper', ['groupedHistories' => $groupedHistories]);
    }

    //Hàm create

}
