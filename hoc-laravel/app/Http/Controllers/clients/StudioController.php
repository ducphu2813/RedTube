<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index(){
        return view('studio.studioBase');
    }

    public function contentsVideos() {
        return view('studio.studioContents');
    }

    public function premium() {
        return view('studio.studioPremium');
    }

    public function profile() {
        return view('studio.studioProfile');
    }

    public function channel() {
        return view('studio.studioChannel');
    }
}
