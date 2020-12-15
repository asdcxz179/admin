<?php

namespace App\Repositories;
use App\Route;
use App\Permission;
/**
 * Class PermissionRepository.
 */
class PermissionRepository
{

    private $AllRoutesName;
    private $AllRoute;
    private $method     =   [
                                'index','show','store','update','destroy',
                            ];

    public function __construct(){
        $this->AllRoutesName    =   collect(\Route::getRoutes()->getRoutesByName())->mapToGroups(function($item,$key){
                                    $route  =   explode(".", $key);
                                    if(isset($route[1])){
                                        return [$route[0]=>$route[1]];    
                                    }
                                })->toArray();
        $this->AllRoute     =   $this->GetAllRoute();
    }

    /* 取得route 資料表 */
    public function GetAllRoute(){
    	return Route::where('status',1)->orderby('parent_id')->orderby('seq')->select('id','name','parent_id','icon','link')->get();
    }

    /* 取得子層資料 */
    public function MakeMenuSub(){
        return $this->AllRoute->where('parent_id', 0);
    }

    /* 製作左側選單 */
    public function GetMenuList(){
        $Parents    =   $this->MakeMenuSub();
        $Permission =   $Parents->map(function($root_item) use ( $Routes ) {
            $father_item = collect($root_item);
            $children = $Routes->where('parent_id', $father_item['id'])->values()->toArray();
            $father_item->put('children', collect($children));
            return $father_item;
        });
        return $Permission;
    }

    /* 取得權限列表 */
    public function GetRouteList(){
    	$Parents   =   $this->MakeMenuSub();
    	$Permission=   $Parents->map(function($root_item){
    		$father_item = collect($root_item);
    		$children = $this->AllRoute->where('parent_id', $father_item['id']);
            $children   =   $children->map(function($item){
                                $sub_item   =   collect($item);
                                $sub_item->put('children',$this->MakeRouteMethod($item['link']));    
                                return $sub_item;
                            });
            $children   =   $children->values()->toArray();
    		$father_item->put('children', collect($children));
    		return $father_item;
    	});
    	return $Permission;
    }

    public function MakeRouteMethod($route){
        if(isset($this->AllRoutesName[$route])){
            return collect($this->AllRoutesName[$route])->map(function($item,$key) use ($route){
                return ['id'=> $route.'.'.$item ,'name'=>$item ];
            });
        }else{
            return [];
        }
    }

    /* 取得route 所有方法 */
    public function GetAllRouteMethod(){
        return $this->AllRoutes;
    }

    /* 取得權限 */
    public function GetPermission($type,$Id){
        return Permission::where($type,$Id)->get()->pluck('method');
    }

    /* 設定權限 */
    public function SetPermission($type,$Id,$Permissions){
        $HasPermissions     =   $this->GetPermission($type,$Id);
        foreach ($HasPermissions as $HasPermission) {
            if(!in_array($HasPermission, $Permissions)){
                $where  =   [
                                $type       =>  $Id,
                                'method'    =>  $HasPermission,
                            ];
                $DeleteResult   =   Permission::where($where)->delete();
                if(!$DeleteResult){
                    return false;
                }
            }else{
                unset($Permissions[array_search($HasPermission,$Permissions)]);
            }
        }
        foreach ($Permissions as $permission) {
            $InsertData     =   [
                                    $type       =>  $Id,
                                    'method'    =>  $permission,
                                ];
            $InsertResult   =   Permission::create($InsertData);
            if(!$InsertResult){
                return false;
            }
        }
    }
}
