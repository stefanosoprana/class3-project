<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        if(empty($request->header('Authorization'))){
            return response()->json([
                'success'=>false,
                'error'=>'Authorization assente',
            ]);
        }

        $apiKey = 'Bearer ' . config('app.api_key');

        if($request->header('Authorization') != $apiKey ){
            return response()->json([
                'success'=>false,
                'error'=>'Authorization errata',
            ]);
        }

        return $next($request);
    }
}
