<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        return view('studio.studioBase');
    }
    public function Analysis()
    {
        return view('users.chart-user');
    }
}
