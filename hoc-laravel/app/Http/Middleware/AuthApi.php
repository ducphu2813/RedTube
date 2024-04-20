<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthApi
{
    public function handle(Request $request, Closure $next)
    {
        echo 'middleware của api';
        echo '<br>';
        return $next($request);
    }
}
