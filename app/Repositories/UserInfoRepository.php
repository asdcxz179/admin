<?php

namespace App\Repositories;

use App\UserInfo;
use Auth;
//use Your Model

/**
 * Class UserInfoRepository.
 */
class UserInfoRepository
{
	/* 取得使用者設定 */
	public function GetInfo($key,$id=''){
		if(!$id){
			$id =	Auth::user()->id;
		}
		$search 	=	UserInfo::where('user_id',$id)->where('key',$key)->select('value')->first();
		if($search){
			return $search->value;
		}
		return NULL;
	}
}
