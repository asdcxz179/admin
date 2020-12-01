<?php

namespace App\Http\Controllers\JwtAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use Exception;
use App\UserInfo;
use DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $InsertRules 	=	[
    								'username'	=>	['required','string','between:6,12','unique:users'],
    								'email'		=>	['required','string','email','max:255','unique:users'],
            						'name'		=>	['required','string','max:20'],
            						'password'	=>	['required','string','between:6,12','confirmed'],
                                    'group'     =>  ['required','exists:group,id'],
                                    'role'      =>  ['required','exists:role,id'],
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
        $Validator 	=	$this->MakeValidate($request);
        if($Validator){
        	try{
                DB::beginTransaction();
	        	$InsertData 	=	[
	        							'username'	=>	$request->username,
	            						'name'		=>	$request->name,
	            						'email'		=>	$request->email,
	            						'password'	=>	Hash::make($request->password),
                                        'uuid'      =>  Str::uuid(),
	        						];
	        	$InsertResult 	=	User::create($InsertData);
	        	if(!$InsertResult){
	        		throw new Exception($this->ReturnError('common.ServiceError'));
	        	}
                $UserId     =   $InsertResult->id;
                foreach (['group','role'] as $type) {
                    $InsertData =   [
                                        'user_id'   =>  $UserId,
                                        'key'       =>  $type,
                                        'value'     =>  $request->{$type},
                                    ];
                    $InsertResult   =   UserInfo::create($InsertData);
                    if(!$InsertResult){
                        throw new Exception($this->ReturnError('common.ServiceError'));
                    }
                }
                DB::commit();
	        	$this->status 	=	'success';
	        	$this->msg 		=	trans('common.RegisterSuccess');
	        }catch(Exception $e){
                DB::rollBack();
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
