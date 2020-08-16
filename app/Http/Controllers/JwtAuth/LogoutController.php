<?php

namespace App\Http\Controllers\JwtAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Carbon;
use App\UserInfo;
use Exception;

class LogoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            auth()->logout();
            $result     =   UserInfo::where(['user_id'=>auth()->user()->id,'key'=>'token'])->update(['value'=>'']);
            if(!$result){
                throw new Exception($this->ReturnError('common.ServiceError'));
            }
            $user = User::find(Auth::id());
            $ip = $request->ip();
            $userAgent = $request->userAgent();
            $authenticationLog = $user->authentications()->whereIpAddress($ip)->whereUserAgent($userAgent)->first();
            if (! $authenticationLog) {
                $authenticationLog = new AuthenticationLog([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                ]);
            }
            $authenticationLog->logout_at = Carbon::now();
            $result     =   $user->authentications()->save($authenticationLog);
            if(!$result){
                throw new Exception($this->ReturnError('common.ServiceError'));
            }
            $this->status   =   'success';
            $this->msg      =   trans('common.LogoutSuccess');
        }catch(Exception $e){
            $this->ReturnError($e->getMessage());
            $this->msg  =   $e->getMessage();
        }
        return $this->ReturnHandle();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
