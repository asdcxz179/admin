<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Repositories\DataTableRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\UserInfo;

class ManagerController extends Controller
{

    public $IndexRules  =   [
                                'page'  =>  'numeric',
                                'limit' =>  'numeric',
                                'orderby'=> 'string',
                                'sort'  =>  'in:asc,desc',
                            ];

    public $UpdateRules =   [
                                'name'      =>  ['required','string','max:20'],
                                'group'     =>  ['required','exists:group,id'],
                                'role'      =>  ['required','exists:role,id'],
                            ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTableRepository $DataTableRepository,Request $request)
    {   
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $this->data     =   User::select(['username','name','email','created_at','uuid']);
                // $DataTableRepository->page  =   $request->page;
                // $DataTableRepository->limit =   $request->limit;
                $this->data     =   $DataTableRepository->make($this->data);
                $this->status   =   'success';
            }catch(Exception $e){
                $this->ReturnError($e->getMessage());
                $this->msg  =   $e->getMessage();
            }
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
        try{
            $this->data     =   User::with(['Info'])->select(['username','name','email','id'])->where('uuid',$id)->first();
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
    public function update(Request $request, $id)
    {
        if($request->password){
            $this->UpdateRules['password']  =   ['required','string','between:6,12','confirmed'];
        }
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $User   =   User::where('uuid',$id)->select(['id'])->first();
                $UserId =   $User->id;
                DB::beginTransaction();
                $UpdateData     =   [
                                        'name'      =>  $request->name,
                                    ];
                if($request->password){
                    $UpdateData['password'] =   Hash::make($request->password);
                }
                $UpdateResult   =   User::where('id',$UserId)->update($UpdateData);
                if(!$UpdateResult){
                    throw new Exception($this->ReturnError('common.ServiceError'));
                }
                foreach (['group','role'] as $type) {
                    $UpdateData =   [
                                        'value'     =>  $request->{$type},
                                    ];
                    $UpdateResult   =   UserInfo::updateOrCreate($UpdateData,['user_id'=>$UserId,'key'=>$type]);
                    if(!$UpdateResult){
                        throw new Exception($this->ReturnError('common.ServiceError'));
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
