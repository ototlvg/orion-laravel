<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
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
//        return response()->json('BLUE BLUE BLUEssss', 201);
        $user = auth()->userOrFail();
        $request->attributes->add(['usuario' => $user]);
        return $next($request);
//        return $next($request);
    }
}
