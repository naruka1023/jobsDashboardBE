<?php

namespace App\Http\Middleware;

use Closure;

class allowOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin','*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS')
            ->header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers,Access-Control-Allow-Methods, Access-Control-Allow-Origin, Origin,Accept, X-Requested-With, Content-Type");
            // ->header("Access-Control-Allow-Credentials", "true");
    }
}
