<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermissionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // test middleware
//        $homeUrl = route('home');
//        return redirect($homeUrl);
        if(session('userPermission') == 1){
            return redirect()->route('clients.homePage');
        }
        return $next($request);
    }
}
