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
        
        return $next($request);
    }
}
