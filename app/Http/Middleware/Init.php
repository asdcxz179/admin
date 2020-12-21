<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class Init
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
        Config::set('auth.defaults.guard','api');
        $lang   =    $request->cookie('lang');
        if($lang){
            app()->setLocale($lang);            
        }
        return $next($request);
    }
}
