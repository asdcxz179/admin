<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Exception;
use App\UserInfo;
use DB;

class DisableManagerController extends Controller
{

    public $UpdateRules =   [
                                'status'    =>  ['required','in:0,1'],
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
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $User   =   User::where('uuid',$id)->select(['id'])->first();
                $UserId =   $User->id;
                $status     =   $request->status;
                DB::beginTransaction();
                $UpdateData     =   [
                                        'status'      =>  $status,
                                    ];
                
                $UpdateResult   =   User::where('id',$UserId)->update($UpdateData);
                if(!$UpdateResult){
                    throw new Exception($this->ReturnError('common.ServiceError'));
                }
                if(!$status){
                    foreach (['token'] as $type) {
                        $UpdateData =   [
                                            'value'     =>  '',
                                        ];
                        $UpdateResult   =   UserInfo::updateOrCreate(['user_id'=>$UserId,'key'=>$type],$UpdateData);
                        if(!$UpdateResult){
                            throw new Exception($this->ReturnError('common.ServiceError'));
                        }
                    }
                }
                DB::commit();
                $this->status   =   'success';
            }catch(Exception $e){
                $this->ReturnError($e->getMessage());
                $this->msg  =   $e->getMessage();
            }
        }
        return $this->ReturnHandle();
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
