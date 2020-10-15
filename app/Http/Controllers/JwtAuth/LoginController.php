<?php

namespace App\Http\Controllers\JwtAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use App\User;
use App\UserInfo;
use Yadahan\AuthenticationLog\AuthenticationLog;
use Illuminate\Support\Carbon;
use Auth;

class LoginController extends Controller
{

    public $captcha_api =   true;
    protected $InsertRules  =   [
                                    'username'  =>  ['required','string','between:6,12','exists:users,username'],
                                    'password'  =>  ['required','string','between:6,12'],
                                ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $credentials = request(['username', 'password']);
                if (! $token = auth()->attempt($credentials)) {
                    $this->status_code  =   401;
                    throw new Exception($this->ReturnError('common.LoginFail'));
                }
                $result     =   UserInfo::updateOrCreate(['user_id'=>auth()->user()->id],['key'=>'token','value'=>$token]);
                if(!$result){
                    throw new Exception($this->ReturnError('common.ServiceError'));
                }
                $ip = $request->ip();
                $userAgent = $request->userAgent();
                $authenticationLog = new AuthenticationLog([
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'login_at' => Carbon::now(),
                ]);
                $result     =   User::find(Auth::id())->authentications()->save($authenticationLog);
                if(!$result){
                    throw new Exception($this->ReturnError('common.ServiceError'));
                }
                $this->data['token']    =   $token;
                $this->data['uuid']     =   Auth::user()->uuid;
                $this->status   =   'success';
                $this->msg      =   trans('common.LoginSuccess');
            }catch(Exception $e){
                $this->ReturnError($e->getMessage());
                $this->msg  =   $e->getMessage();
            }   
        }
        return $this->ReturnHandle();
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
