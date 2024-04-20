<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin{

    public function handle(Request $request, Closure $next){

        if(!$request->session()->has('loggedInUser')){
            return redirect()->route('login-register');
        }
        return $next($request);
    }

}
