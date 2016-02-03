<?php

namespace App\Http\Middleware;

use Closure;

class LeaderMiddleware
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


        if((\Auth::user()->hak_akses == 2) || (\Auth::user()->hak_akses == 1)){
            return $next($request);
        }else {
            return redirect(\URL::to('error'));
        }
    }
}
