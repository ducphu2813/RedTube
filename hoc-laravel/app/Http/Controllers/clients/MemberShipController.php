<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class MemberShipController extends Controller
{
    public function showCreateMemberShip()
    {
        return view('membership.membershipModal');
    }

    public function showAllMembership()
    {
        $listMembership = Cache::remember('list_membership', 0, function () {
            return Membership::getAllMembership();
        });

        return view('membership.membershipWrapper', ['listMembership' => $listMembership]);
    }

    public function createMemberPackage(Request $request, $id) {
        $ms = Membership::getMembershipById($id);
        return response()->json($ms);
    }
}
