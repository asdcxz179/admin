<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\PermissionRepository;
use App\Repositories\RestfulRepository;

class ApiPermission
{
    use RestfulRepository;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $PermissionRepository   =   new PermissionRepository;
        $route  =   \Route::currentRouteName();
        $check  =   $PermissionRepository->CheckPermission($route);
        if(!$check){
            $this->status_code    =   403;
            return $this->ReturnHandle();
        }
        return $next($request);
    }
}
