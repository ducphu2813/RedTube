<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function abc(){
        return view('admin.admin');
    }

    public function showAll(){
        return view('admin.layout');
    }
}
