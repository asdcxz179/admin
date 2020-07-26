<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Repositories\RestfulRepository;

class Authenticate extends Middleware
{
    use RestfulRepository;
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);
                return $next($request);
            }
        }
        $this->status_code  =   401;
        $this->msg  =   trans('common.Unauthorized');
        return $this->ReturnHandle();
    }
}
