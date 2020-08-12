<?php

namespace App\Http\Middleware;

use Closure;

class CheckCookie
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
//        return response()->json('BLUE BLUE BLUE', 201);
//        return $next($request);
//        $value = $request->cookie('jwt');
        $value = $request->cookie('jwt');
//        return $value;
        if(empty($value)){
//            return response()->json('No se mando el Cookie JWT', 401);
            return response()->json(['message' => 'Falta el cookie', 'type'=>1],401);
        }
        $request->headers->set('Authorization', 'Bearer '.$value);
//        return response()->json($request->get('token'), 201);
        return $next($request);
    }
}
