<?php

namespace App\Repositories;
//use Your Model

use Illuminate\Http\Request;
use App\Repositories\ValidateRepository;
/**
 * Class DataTableRepository.
 */
class DataTableRepository
{
	use ValidateRepository;

	

	public $page =	1;
	public $limit 	=	10;

    public function make($eloquent){
    	$request 	=	new Request();
        $page 	=	($request->page)?$request->page:$this->page;
    	$limit 	=	($request->limit)?$request->limit:$this->limit;
    	if($request->orderby){
    		$eloquent->orderby($request->orderby,$request->sort);
    	}
    	return [
    		'total'	=>	$eloquent->count(),
    		'data'	=>	$eloquent->skip((($page-1)*$limit))->take($limit)->get(),
    	];	
    }
}
