<?php

namespace App\Http\Controllers\Restful;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Route;
use Exception;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $routes     =   Route::select(['id','name','parent_id','icon','link'])->where('status',1)->orderby('parent_id')->get();
            foreach ($routes as $route) {
                if($route->parent_id==0){
                    $this->data[$route->id] =   [
                                                    'icon'      =>  $route->icon,
                                                    'text'      =>  $route->name,
                                                    'icon-alt'  =>  'mdi-chevron-down',
                                                    'link'      =>  $route->link,
                                                ];
                }else{
                    if(isset($this->data[$route->parent_id])){
                        $this->data[$route->parent_id]['children'][$route->id]  =   [
                                                                                        'icon'  =>  $route->icon,
                                                                                        'text'  =>  $route->name,
                                                                                        'link'  =>  $route->link,
                                                                                    ];
                    }
                }
                
            }
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
