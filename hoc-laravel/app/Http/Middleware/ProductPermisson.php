<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductPermisson{


    public function handle(Request $request, Closure $next)
    {
        echo 'middleware kiểm tra quyền sản phẩm';
        echo '<br>';
        return $next($request);
    }

}
