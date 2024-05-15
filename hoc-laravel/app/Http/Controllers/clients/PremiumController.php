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

        if($currentUserPremium == null){
            return view('premium.no-premium');
        } else if ($currentUserPremium->getAvailableShares() <= 0) {
            return view('premium.no-share');
        }

        return view('premium.test-add');
    }

    //xử lý gửi lời mời share
    public function handleSend(Request $request)
    {

        if(!session('loggedInUser')){
            return response()->json([
                'status' => 400,
                'message' => 'Bạn cần đăng nhập để thực hiện chức năng này'
            ]);
        }

        //tìm user theo user_name
        $user = Users::getUserByName($request->input('user_name'));

        if($user == null){
            return response()->json([
                'status' => 400,
                'message' => 'Không tìm thấy user'
            ]);
        }

        if($user->user_id == session('loggedInUser')){
            return response()->json([
                'status' => 400,
                'message' => 'Không thể chia sẻ với chính mình'
            ]);
        }

        //lấy ra gói premium đang sử dụng hiện tại của user
        $currentUserPremium = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        if($currentUserPremium == null){
            return response()->json([
                'status' => 400,
                'message' => 'Bạn chưa mua gói premium'
            ]);
        }

        //kiểm tra xem user có thể gửi thông báo chia sẻ không
        $shareStaus = ShareNoti::isSendable(session('loggedInUser'), $user->user_id, $currentUserPremium->registration_id);

        if($shareStaus == 'alreadysent'){
            return response()->json([
                'status' => 400,
                'message' => 'Bạn đã gửi lời mời cho ' . $user->user_name . ' rồi',
                'pre_id' => $currentUserPremium->registration_id,
                'user_id' => $user->user_id,
                'sender_id' => session('loggedInUser')
            ]);
        }
        elseif ($shareStaus == 'receiverusingsenderpremium'){
            return response()->json([
                'status' => 400,
                'message' => $user->user_name . ' đang sử dụng gói premium của bạn',
                'pre_id' => $currentUserPremium->registration_id,
                'user_id' => $user->user_id,
                'sender_id' => session('loggedInUser')
            ]);
        }
        elseif ($shareStaus == 'sharelimitexceeded'){
            return response()->json([
                'status' => 400,
                'message' => 'Số lượng người dùng hiện tại đã đạt giới hạn chia sẻ',
                'pre_id' => $currentUserPremium->registration_id,
                'user_id' => $user->user_id,
                'sender_id' => session('loggedInUser')
            ]);
        }

        //khi thỏa tất cả điều kiện trên thì create 1 ShareNoti
        $shareNotiModel = new ShareNoti();
        $data['sender_id'] = session('loggedInUser');
        $data['receiver_id'] = $user->user_id;
        $data['registration_id'] = $currentUserPremium->registration_id;
        $data['status'] = 0;
        $data['expiry_date'] = $currentUserPremium->end_date; //lấy ngày hết hạn của gói premium của user

        $shareNotiModel->createShareNoti($data);

        return response()->json([
            'status' => 200,
            'message' => 'Gửi thông báo chia sẻ thành công',
            'pre_id' => $currentUserPremium->registration_id,
            'user_id' => $user->user_id,
            'sender_id' => session('loggedInUser'),
            'share_noti_object' => $data,
        ]);

        //cái này để debug thôi, không cần quan tâm
        //return response()->json($data);

    }

    //xử lý xóa share(kể cả lời mời)
    public function handleDeleteShare(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        if($data['obj'] == 'using_share'){
            //nếu là hủy người đang dùng chung gói premium

            //lấy ra SharePremium theo share_id
            $sharePremium = SharePremium::getShareById($data['obj_id']);

            //update ngày hết hạn là ngày hiện tại
            $sharePremium['expiry_date'] = date('Y-m-d H:i:s');

            //cập nhật vào dtb
            $sharePremium->updateSharePremium($sharePremium->share_id, $sharePremium->toArray());

            return response()->json([
                'status' => 200,
                'message' => 'Hủy chia sẻ thành công',
                'object' => $sharePremium,
            ]);
        }
        elseif($data['obj'] == 'share_noti'){
            //nếu là xóa thông báo share

            //tìm thông báo chia sẻ theo obj_id
            $shareNotiModel = new ShareNoti();
            $shareNoti = $shareNotiModel->getNotiById($data['obj_id']);

            //xóa thông báo chia sẻ
            $shareNoti->deleteNotiById($shareNoti->noti_id);

            return response()->json([
                'status' => 200,
                'message' => 'Xóa thông báo chia sẻ thành công',
                'object' => $shareNoti,
            ]);
        }

        return response()->json([
            'status' => 400,
            'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau',
            'share_noti_object' => $data,
        ]);
    }

    public function handleAcceptPremium(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
    }

    //show danh sách người share
    public function showModalPremium(Request $request){

        $registration_id = $request->input('registration_id');
        $premiumRegistrationModel = new PremiumRegistration();

        //lấy ra gói premium đang sử dụng hiện tại của user
        $premiumRegistration = $premiumRegistrationModel->getPremiumRegistrationById($registration_id);

        //lấy những thoông báo gửi share
        $shareNoti = ShareNoti::getNotiByRegistrationId($registration_id);

        return view('premium.premiumShareList', ['premiumRegistration' => $premiumRegistration, 'shareNoti' => $shareNoti]);
    }

    public function getAllRegistrations(){

        //record premium đang sử dụng
        $data['current_premium'] = PremiumRegistration::getCurrentPremiumRegistrationByUser(session('loggedInUser'));

        //record shared premium đang được share
        $data['current_shared_premium'] = SharePremium::getCurrentSharedPremiumByUser(session('loggedInUser'));

        //tất cả record mua premium của user
        $data['all_premium'] = PremiumRegistration::getAllPremiumRegistrationsByUser(session('loggedInUser'));

        return view('premium.premiumWrapper', $data);
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

    // Danh sách đăng ký premium của bản thân
    public function mySharePremium(){

        //tất cả record mua premium của user
        $data['all_premium'] = PremiumRegistration::getAllPremiumRegistrationsByUser(session('loggedInUser'));

        return view('premium.premiumShareWrapper', $data);
    }

    // Nhận chia sẻ
    public function receiveShare(){

        //lấy tất cả những premium đc share cho user
        $data['all_shared_premium'] = SharePremium::getAllSharedPremiumsByUser(session('loggedInUser'));

        return view('premium.premiumHistoryWrapper', $data);
    }

    // Modal invate
    public function invitePremium(){

        return view('premium.premiumInvate');
    }
}
