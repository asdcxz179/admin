<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware as Middleware;
use App\Repositories\RestfulRepository;
use App\Repositories\UserInfoRepository;
use Exception;

class Authenticate extends Middleware
{
    use RestfulRepository;
    public function handle($request, Closure $next )
    {
        $check  =   $this->authenticate($request);
        if($check){
            $UserInfoRepository = new UserInfoRepository();
            $token  =   $UserInfoRepository->GetInfo('token');
            if($token==$this->auth->getToken()){
                return $next($request);        
            }
        }
        $this->status_code  =   401;
        $this->msg  =   trans('common.Unauthorized');
        return $this->ReturnHandle();
    }

    public function authenticate($request)
    {
        $this->checkForToken($request);
        try {
            if (! $this->auth->parseToken()->authenticate()) {
                $this->msg  =   trans('common.UserNotFound');
                $this->status_code  =   401;
                return false;
            }
        } catch (Exception $e) {
            $this->msg  =   $e->getMessage();
            $this->status_code  =   401;
            return false;
        }
        return true;
    }
}
