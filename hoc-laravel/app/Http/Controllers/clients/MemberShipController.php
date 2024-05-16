<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\UserMembership;
use App\Models\Users;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;


class MemberShipController extends Controller
{
    public function showCreateMemberShip()
    {
        return view('membership.membershipModal');
    }

    public function showAllMembership(Request $request)
    {
        $userId = session('loggedInUser');

        if(!$userId){
            return redirect()->route('login-register');
        }

        //lấy tất cả gói membership của user
        $listMembership = Membership::getMembershipByUserId($userId);

        //lấy tất cả gói membership đã đăng ký của user
        $listMembershipRegistered = UserMembership::getUserMembership($userId);

        return view('membership.membershipWrapper',
            [
                'listMembership' => $listMembership,
                'listMembershipRegistered' => $listMembershipRegistered
            ]);
    }

    public function showAllMemberPackage(Request $request){
        $userId = session('loggedInUser');

        if(!$userId){
            return redirect()->route('login-register');
        }

        $listMembership = Membership::getMembershipByUserId($userId);

        return view('membership.membership-package-wrapper', ['listMembership' => $listMembership]);
    }

    public function showAllMembershipRegistration(){

        $userId = session('loggedInUser');

        //lấy tất cả gói membership đã đăng ký của user
        $listMembershipRegistered = UserMembership::getUserMembership($userId);

        return view('membership.membership-registration',
            [
                'listMembershipRegistered' => $listMembershipRegistered
            ]
        );
    }

    public function createMemberPackage(Request $request, $id) {
        $ms = Membership::getMembershipById($id);
        return response()->json($ms);
    }

    //xử lý hủy gói đăng ký
    public function handleCancel(Request $request) {

        $userId = session('loggedInUser');

        $data = $request->all();

        unset($data['_token']);

        $subscription = UserMembership::getUserMembershipById($data['id']);

        if(!$subscription){
            return response()->json([
                'status' => 400,
                'message' => 'Không tìm thấy gói đăng ký'
            ]);
        }
        else{
            $subscription->end_date = date('Y-m-d H:i:s');
            $subscription->save();

            return response()->json([
                'status' => 200,
                'message' => 'Hủy gói thành công'
            ]);
        }
    }
}
