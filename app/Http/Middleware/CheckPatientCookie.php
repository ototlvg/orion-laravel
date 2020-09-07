<?php

namespace App\Http\Middleware;

use Closure;

class CheckPatientCookie
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
//        return response()->json('Energia cosmica',201);
        return $next($request);
    }
}
