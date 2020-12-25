<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Experience;
use Illuminate\Support\Str;

class ExperienceController extends Controller
{
    protected $InsertRules  =   [
                                    'job_company'       =>  ['required','string'],
                                    'job_title'         =>  ['required','string'],
                                    'job_content'       =>  ['required','string'],
                                    'job_start_date'    =>  ['required','date_format:Y-m-d'],
                                    // 'job_end_date'      =>  ['date_format:Y-m-d'],
                                    'status'            =>  ['required','in:0,1'],
                                ];
    protected $UpdateRules  =   [
                                    'job_company'       =>  ['required','string'],
                                    'job_title'         =>  ['required','string'],
                                    'job_content'       =>  ['required','string'],
                                    'job_start_date'    =>  ['required','date_format:Y-m-d'],
                                    // 'job_end_date'      =>  ['date_format:Y-m-d'],
                                    'status'            =>  ['required','in:0,1'],
                                ];
    protected $DeleteRules  =   [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $this->data     =   Experience::select(['uuid','job_title','job_start_date','job_end_date','job_content','status','job_company'])->orderby('job_start_date','desc')->get();
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
                $InsertData =   [
                                    'uuid'          =>  Str::uuid(),
                                    'job_company'   =>  $request->job_company,
                                    'job_title'     =>  $request->job_title,
                                    'job_content'   =>  $request->job_content,
                                    'job_start_date'=>  $request->job_start_date,
                                    'job_end_date'  =>  $request->job_end_date,
                                    'status'        =>  $request->status,
                                ];
                $result     =   Experience::create($InsertData);
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
    public function show($id)
    {
        try{
            $this->data     =   Experience::where(['uuid'=>$id])->select(['uuid','job_title','job_start_date','job_end_date','job_content','status','job_company'])->first();
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
        $Validator  =   $this->MakeValidate($request);
        if($Validator){
            try{
                $UpdateData =   [
                                    'job_company'   =>  $request->job_company,
                                    'job_title'     =>  $request->job_title,
                                    'job_content'   =>  $request->job_content,
                                    'job_start_date'=>  $request->job_start_date,
                                    'job_end_date'  =>  $request->job_end_date,
                                    'status'        =>  $request->status,
                                ];
                $result     =   Experience::where(['uuid'=>$id])->update($UpdateData);
                if(!$result){
                    throw new Exception($this->ReturnError('common.UpdateFail'));
                }
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
        // $Validator  =   $this->MakeValidate($request);
        // if($Validator){
            try{
                $result     =   Experience::where(['uuid'=>$id])->first()->delete();
                if(!$result){
                    throw new Exception($this->ReturnError('common.DeleteFail'));
                }
                $this->status   =   'success';
                $this->msg      =   trans('common.DeleteSuccess');
            }catch(Exception $e){
                $this->ReturnError($e->getMessage());
                $this->msg  =   $e->getMessage();
            }   
        // }
        return $this->ReturnHandle();
    }
}
