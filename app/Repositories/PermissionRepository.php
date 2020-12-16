<?php

namespace App\Repositories;
use App\Route;
use App\Permission;
use App\Repositories\UserInfoRepository;
use Auth;
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
    private $IgnoreRoute    =   [
                                    'Check.index','Route.index','Permission.index',
                                ];

    public function __construct(){
        $this->AllRoutesName    =   collect(\Route::getRoutes()->getRoutesByName())->mapToGroups(function($item,$key){
                                    $route  =   explode(".", $key);
                                    if(isset($route[1])){
                                        return [$route[0]=>$route[1]];    
                                    }
                                })->toArray();
        $this->AllRoute     =   $this->GetAllRoute();
        $this->UserInfoRepository =     new UserInfoRepository();
    }

    /* 取得route 資料表 */
    public function GetAllRoute(){
    	return Route::where('status',1)->orderby('parent_id')->orderby('seq')->select('id','name','parent_id','icon','link')->get();
    }

    /* 取得子層資料 */
    public function MakeMenuSub($id=0){
        return $this->AllRoute->where('parent_id', $id);
    }

    /* 製作左側選單 */
    public function GetMenuList(){
        $Parents    =   $this->MakeMenuSub();
        $ManagerPermission = $this->GetManagerPermisstion();
        $MakeMenu   =   function($item,$data) use ($ManagerPermission){
            if(!in_array($data->link.'.index', $ManagerPermission) && $data->link){
                return [];
            }
            $item->put('text',$data->name);
            $item->put('icon',$data->icon);
            $item->put('link',$data->link);
            return $item;    
        };
        $Permission =   $Parents->map(function($item) use ($MakeMenu){
            $new_item = collect([]);
            $new_item  = $MakeMenu($new_item,$item);
            if($new_item){
                $children = $this->AllRoute->where('parent_id', $item['id'])->values()->map(function($item) use ($MakeMenu){
                    $new_item = collect([]);
                    $new_item = $MakeMenu($new_item,$item);
                    return $new_item;
                })->toArray();
                $children = array_filter($children);
                if($children){
                    $new_item->put('children', collect($children));
                    $new_item->put('icon-alt','mdi-chevron-down');    
                }else if(!$item->link){
                    return [];
                }
            }
            return $new_item;
        });
        return  array_filter($Permission->toArray());
    }


    /* 取得權限列表 */
    public function GetRouteList(){
    	$Parents   =   $this->MakeMenuSub();

        $Sub    =   function($items) use (&$Sub){
            $new_items = $items->map(function($item) use (&$Sub){
                $new_item   =   collect($item);
                $children = $this->MakeMenuSub($new_item['id']);
                $method     =   [];
                if($new_item['link']){
                    $method  = $this->MakeRouteMethod($new_item['link'])->toArray();
                }
                if($children->count()){
                    $sub_children   =   collect($Sub($children))->values()->toArray();
                    $method     =   array_merge($method,$sub_children);
                }
                $new_item->put('children',collect($method));
                return $new_item;
            });
            return $new_items;
        };
    	return $Sub($Parents);
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

    /* 取得管理員權限 */
    public function GetManagerPermisstion(){
        $group  =   $this->UserInfoRepository->GetInfo('group');
        $role   =   $this->UserInfoRepository->GetInfo('role');
        return  Permission::where('group_id',$group)->orwhere('role_id',$role)->groupby('method')->select('method')->pluck('method')->toArray();
    }

    /* 權限檢查 */
    public function CheckPermission($route){
        return in_array($route, array_merge($this->IgnoreRoute,$this->GetManagerPermisstion()));
    }
}
