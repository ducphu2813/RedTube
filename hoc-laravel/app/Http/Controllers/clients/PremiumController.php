<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PremiumRegistration;
use App\Models\ShareNoti;
use App\Models\Users;
use Illuminate\Http\Request;

class PremiumController extends Controller
{

    public function index()
    {

    }

    public function sharePage(Request $request){

        $currentUserPremium = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        //danh sách những người đã mời chia sẻ
//        $receiverList =

        if($currentUserPremium == null){
            return view('premium.no-premium');
        }
        else if($currentUserPremium->getAvailableShares() <= 0){
            return view('premium.no-share');
        }

        return view('premium.test-add');
    }

    public function findUser(Request $request){
        $nameFind = $request->input('name');

        $currentUserPremium = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        $listUsers = Users::getUsersByName($nameFind);

        foreach ($listUsers as $user){

            //kiểm tra xem user có thể gửi thông báo chia sẻ không
            if(ShareNoti::isSendable(session('loggedInUser'), $user->user_id)){
                $user->isSendable = true;
            }
            else{
                $user->isSendable = false;
            }
        }

        return response()->json(['data' => $listUsers,
            'current_user_premium' => $currentUserPremium,
            ]);
    }

    public function handleSend(Request $request){
        //lấy tất cả dữ liệu từ form
        //bao gồm: user_id, registration_id, created_date
        $data = $request->all();

        unset($data['_token']);

        //kiểm tra gói premium có còn hạn không
        if(PremiumRegistration::isPremiumExpired($data['registration_id']) ){

            return response()->json([
                'status' => 400,
                'message' => 'Gói premium đã hết hạn'
            ]);
        }

        if(ShareNoti::createShareNoti($data)) {

            return response()->json([
                'status' => 200,
                'message' => 'Gửi thông báo chia sẻ thành công'
            ]);
        }
        else{
            return response()->json([
                'status' => 400,
                'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
            ]);
        }

        //cái này để debug thôi, không cần quan tâm
//        return response()->json($data);

    }

    public function handleAcceptPremium(Request $request){
        $data = $request->all();

        unset($data['_token']);


    }
}
