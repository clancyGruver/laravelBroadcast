<?php

namespace App\Http\Middleware;

use Closure;

class Nonsec
{
    public function handle($request, Closure $next)
    {
        if($request->secure()) {
            return redirect($request->path());
        }

        return $next($request);
    }
}