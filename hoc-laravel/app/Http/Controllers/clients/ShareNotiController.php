<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\ShareNoti;

class ShareNotiController extends Controller
{
    public function index(){

    }

    public function notiPage(){

        return view('premium.noti-page');
    }

    public function getNoti(){

        $notiList = ShareNoti::getNotiByReceiver(session('loggedInUser'));

        foreach ($notiList as $noti){
            $noti->sender = $noti->sender();
            $noti->premiumRegistration = $noti->registration();
        }

        return response()->json(['data' => $notiList]);
    }
}
