<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Repositories\DataTableRepository;

class ManagerController extends Controller
{

    public $IndexRules  =   [
                                'page'  =>  'numeric',
                                'limit' =>  'numeric',
                                'orderby'=> 'string',
                                'sort'  =>  'in:asc,desc',
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
