<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use Exception;
use App\Repositories\DataTableRepository;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    protected $InsertRules  =   [
                                    'name'  =>  ['required','string'],
                                ];

    protected $UpdateRules  =   [
                                    'name'  =>  ['required','string'],
                                    'permission'    =>  [],
                                ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTableRepository $DataTableRepository,Request $request)
    {
        try{
            $this->data     =   Role::select(['id','name','created_at']);
            $this->data     =   $DataTableRepository->make($this->data);
            $this->status   =   'success';
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
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $result     =   Role::create(['name'=>$request->name]);
                if(!$result){
                    throw new Exception($this->ReturnError('common.InsertFail'));
                }
                $this->status   =   'success';
                $this->msg      =   trans('common.InsertSuccess');
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
    public function show($id,PermissionRepository $PermissionRepository)
    {
        try{
            $this->data['info']     =   Role::where(['id'=>$id])->select(['id','name'])->first();
            $this->data['permission']   =   $PermissionRepository->GetPermission('role_id',$id);
            $this->status   =   'success';
        }catch(Exception $e){
            $this->ReturnError($e->getMessage());
            $this->msg  =   $e->getMessage();
        }
        return $this->ReturnHandle();
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
    public function update(Request $request, $id,PermissionRepository $PermissionRepository)
    {
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $result     =   Role::where(['id'=>$id])->update(['name'=>$request->name]);
                if(!$result){
                    throw new Exception($this->ReturnError('common.UpdateFail'));
                }
                $permission     =   $PermissionRepository->SetPermission('role_id',$id,$request->permission);
                $this->status   =   'success';
                $this->msg      =   trans('common.UpdateSuccess');
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
