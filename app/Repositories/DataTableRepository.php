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

	public function __construct(Request $request){
        $this->request  =   $request;
    }

	public $page =	1;
	public $limit 	=	10;

    public function make($eloquent){
        $page 	=	($this->request->page)?$this->request->page:$this->page;
    	$limit 	=	($this->request->limit)?$this->request->limit:$this->limit;
    	if($this->request->orderby){
    		$eloquent->orderby($this->request->orderby,$this->request->sort);
    	}
    	return [
    		'total'	=>	$eloquent->count(),
    		'data'	=>	($this->request->limit<0)?$eloquent->get():$eloquent->skip((($page-1)*$limit))->take($limit)->get(),
    	];	
    }
}
