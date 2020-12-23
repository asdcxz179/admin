<?php

namespace App\Repositories;
use App\Settings;

/**
 * Class SystemSettingRepository.
 */
class SystemSettingRepository 
{
	private $settings;
	private $select 	=	['key','value'];

	public function __construct(Settings $Settings){
		$this->settings 	=	$Settings;
	}

	public function SetSelect(){
		return $this->settings->select($this->select);
	}

	public function SetWhereIn($keys){
		return $this->settings->whereIn('key',$keys);
	}

	public function GetSettings($keys=[]){
		$this->settings 	=	$this->SetSelect();
		if($keys){
			$this->settings =	$this->SetWhereIn($keys);
		}
		return $this->settings->get()->pluck('value','key');
	}

}
