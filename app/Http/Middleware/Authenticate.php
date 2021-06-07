<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Contracts\Auth\Factory as Auth;

use Illuminate\Support\Facades\Auth;

class Authenticate
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    //try - catch para validação do Token (payload)
    public function handle($request, Closure $next, $guard = null)
    {
        try{
            $user = Auth::payload();

        }catch(\Tymon\JWTAuth\Exceptions\JWTExpiredException $e){

            return response()->json(['token_exiprado' => $e->getMessage()], 500);

        }catch(\Tymon\JWTAuth\Exceptions\JWTInvalidException $e){

            return response()->json(['token_invalido' => $e->getMessage()], 500);

        }catch(\Tymon\JWTAuth\Exceptions\JWTException $e){

            return response()->json(['token_ausente' => $e->getMessage()], 500);
        }
        return $next($request);
    }
}
