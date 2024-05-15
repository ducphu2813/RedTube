<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Membership;
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

        $listMembership = Membership::getMembershipByUserId($userId);

        return view('membership.membershipWrapper', ['listMembership' => $listMembership]);
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
        return view('membership.membership-registration');
    }

    public function createMemberPackage(Request $request, $id) {
        $ms = Membership::getMembershipById($id);
        return response()->json($ms);
    }
}
