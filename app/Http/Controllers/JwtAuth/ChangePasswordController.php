<?php

namespace App\Http\Controllers\JwtAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    protected $UpdateRules  =   [
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
                $result     =   User::where(['id'=>auth()->user()->id])->update(['password' =>  Hash::make($request->password)]);
                if(!$result){
                    throw new Exception($this->ReturnError('common.ServiceError'));
                }
                $this->status   =   'success';
                $this->msg      =   trans('common.ChangePasswordSuccess');
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
