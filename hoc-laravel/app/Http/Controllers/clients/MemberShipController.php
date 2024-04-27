<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberShipController extends Controller
{
    public function showCreateMemberShip(){
        return view('membership.memberPackageModal');
    }
}
