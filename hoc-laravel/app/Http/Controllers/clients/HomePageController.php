<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(){
        return view('main.homePageBase');
    }
    
    public function buyPremium(){
        return view('premium.privatePremiumBuy');
    }
}
