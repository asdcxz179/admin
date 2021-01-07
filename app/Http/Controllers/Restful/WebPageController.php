<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\WebPageRepository;
use App\WebPage;
use Illuminate\Support\Str;

class WebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WebPageRepository $WebPageRepository)
    {
        try{
            $this->data     =   $WebPageRepository->GetWabPage();
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
        try{
            $where  =   [
                            'page_title'   =>  $id,
                        ];
            $content    =   preg_replace_callback('/"(data:image.*?;base64,.*?)"/is',
                                function($match) use ($id){
                                    if(isset($match[1])){
                                        return env('APP_URL').createImage($match[1],$id.'/'.Str::uuid());    
                                    }
                                }
                                ,$request->page_content);
            $data   =   [
                            'page_content' =>  $content,
                        ];
            $result     =   WebPage::where($where)->update($data);
            if(!$result){
                throw new Exception($this->ReturnError('common.UpdateFail'));
            }    
            $this->status   =   'success';
            $this->msg      =   trans('common.UpdateSuccess');
        }catch(Exception $e){
            $this->ReturnError($e->getMessage());
            $this->msg  =   $e->getMessage();
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
