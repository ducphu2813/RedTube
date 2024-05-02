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

//        $data['noti_id'] = $noti->noti_id;
//        $data['sender'] = $noti->sender;
//        $data['premium_registration_id'] = $noti->premium_registration_id;
//        $data['status'] = $noti->status;
//        $data['created_date'] = $noti->created_date;

        return response()->json(['data' => $notiList]);
    }
}
