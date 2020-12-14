<?php

namespace App\Repositories;
use App\Route;

/**
 * Class PermissionRepository.
 */
class PermissionRepository
{
    public function GetAllRoute(){
    	return Route::where('status',1)->orderby('parent_id')->orderby('seq')->select('id','name','parent_id','icon','link')->get();
    }

    public function GetRouteList(){
    	$Routes 	=	$this->GetAllRoute();
    	$Parents = $Routes->where('parent_id', 0);
    	$Permission = $Parents->map(function($root_item) use ( $Routes ) {
    		$father_item = collect($root_item);
    		$children = $Routes->where('parent_id', $father_item['id'])->values()->toArray();
    		$father_item->put('children', collect($children));
    		return $father_item;
    	});
    	return $Permission;
    }

    public function MakeRouteMethod($route){
        
    }
}
