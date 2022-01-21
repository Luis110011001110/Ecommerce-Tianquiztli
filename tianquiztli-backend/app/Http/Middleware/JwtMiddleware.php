<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        try{
            $user = JWTAuth::parseToken()->authenticate();
        } catch(Exception $e){
            if($e instanceof \tymon\JWTAuth\Exceptions\TokenInvalidException){
              return response()->json(["message" =>"Invalid token"]);
            } 
            if($e instanceof \tymon\JWTAuth\Exceptions\TokenExpiredException){
               return response()->json(["message" =>"Expired token"]);
            }
            return response()->json(["message" =>"token not found"]);    
        }

        return $next($request);
    }
}
