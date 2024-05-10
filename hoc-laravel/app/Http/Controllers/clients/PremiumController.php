<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PremiumPackage;
use App\Models\PremiumRegistration;
use App\Models\ShareNoti;
use App\Models\SharePremium;
use App\Models\Users;
use Illuminate\Http\Request;

class PremiumController extends Controller
{

    public function index()
    {
    }

    public function sharePage(Request $request)
    {

        $currentUserPremium = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        if ($currentUserPremium == null) {
            return view('premium.no-premium');
        } else if ($currentUserPremium->getAvailableShares() <= 0) {
            return view('premium.no-share');
        }

        return view('premium.test-add');
    }

    public function findUser(Request $request)
    {
        $nameFind = $request->input('name');

        $currentUserPremium = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        $listUsers = Users::getUsersByName($nameFind);

        foreach ($listUsers as $user) {
            if (ShareNoti::isSendable(session('loggedInUser'), $user->user_id)) {
                $user->isSendable = true;
            } else {
                $user->isSendable = false;
            }
        }

        return response()->json([
            'data' => $listUsers,
            'current_user_premium' => $currentUserPremium,
        ]);
    }

    public function handleSend(Request $request)
    {
        //lấy tất cả dữ liệu từ form
        //bao gồm: user_id, registration_id, created_date
        $data = $request->all();

        unset($data['_token']);

        //kiểm tra gói premium có còn hạn không
        if (PremiumRegistration::isPremiumExpired($data['registration_id'])) {

            return response()->json([
                'status' => 400,
                'message' => 'Gói premium đã hết hạn'
            ]);
        }

        if (ShareNoti::createShareNoti($data)) {

            return response()->json([
                'status' => 200,
                'message' => 'Gửi thông báo chia sẻ thành công'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau'
            ]);
        }

        //cái này để debug thôi, không cần quan tâm
        //        return response()->json($data);

    }

    public function handleAcceptPremium(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
    }

    public function getAllRegistrations(){
        // Lấy tất cả gói premium (không quan tâm user_id)
        // $data['listRegistrations'] = PremiumRegistration::getAllPremiumRegistrationsByUser($id);

        // Lấy tất cả user đã được share gói premium
        // $data['listShares'] = $data['listRegistrations']->sharedUsers();
        // $data[]

        // đếm user được share gói premium
        // $data['countUser'] = $data['listShares']->getAllSharedUsersCount();

        $data = PremiumRegistration::getAllNoCondition();
        return view('premium.premiumWrapper', $data);
    }

    public function showModalPremium(){
        return view('premium.premiumShareList');
    }

    // -----------------Dương muốn note-----------------
// Cái này là nếu thằng user có sở hữu pre gòi thì khi nhấn vào mua thì nó hiện lên là m muốn mua nữa không ?
// Còn share nếu có gói premium thì nội dung thay đổi thành "Bạn có muốn chia sẻ cho ai không"
// Cái btn nó sẽ chia ra làm 2 function
// có thì chuyển tới trang premium trong studio
// không thì chuyển tới trang mua premium 

    // Chưa mua premium cá nhân
    public function buyPremium(){
        return view('premium.privatePremiumBuy');
    }

    // Chưa mua premium cá nhân nên không share được
    public function noPremium(){
        return view('premium.no-premium-no-share');

    }
}
