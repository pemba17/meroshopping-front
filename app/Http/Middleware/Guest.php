<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;
use Illuminate\Support\Str;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $device=Cookie::get('device');
        if($device==null){
            $device_id=(string) Str::uuid();
            $response = $next($request);
            return $response->withCookie(cookie()->forever('device', $device_id));
        }else{
            return $next($request);
        }
    }
}
