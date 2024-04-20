<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoggedIn{

    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('loggedInUser')){
            //kiểm tra nếu đã đăng nhập thì chuyển hướng về trang dashboard
            return redirect()->route('users.dashboard');
        }
        return $next($request);
    }
}
