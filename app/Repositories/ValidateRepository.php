<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Validator;
use Route;
/**
 * Class ValidateRepository.
 */
Trait ValidateRepository
{
	public $Rules 	=	[];
	public $SetAttributeNames	=	[];
    public $captcha =   false;
    public $captcha_api =   false;
    public function MakeValidate($request){
    	$RouteName 	=	explode(".", Route::currentRouteName());
    	$Name 		=	$RouteName[0];
		$Method 	=	$RouteName[1];
		switch ($Method) {
    		case 'store':
    			if(isset($this->InsertRules)){
    				$this->Rules 	=	$this->InsertRules;
    			}
    			break;
    		case 'update':
    			if(isset($this->UpdateRules)){
    				$this->Rules 	=	$this->UpdateRules;
    			}
    			break;
    		case 'destroy':
    			if(isset($this->DeleteRules)){
    				$this->Rules 	=	$this->DeleteRules;
    			}
    			break;
    	}
    	if(!$this->Rules){
    		return true;
    	}
        if($this->captcha){
            $this->Rules['captcha']  =   ['required','captcha'];
        }
        if($this->captcha_api){
            $this->Rules['captcha']  =   ['required','captcha_api:'.$request->captcha_key];
        }
    	$keys 	=	array_keys($this->Rules);
    	foreach ($keys as $value) {
    		$this->SetAttributeNames[$value] 	=	trans('common.'.'Validate_'.$Name.'.'.$value);
    	}
		$Validator 	=	Validator::make($request->all(),$this->Rules);
		$Validator->setAttributeNames($this->SetAttributeNames);	
		if(!$Validator->passes()){
			$this->status_code 	=	422;
			$this->msg  =   implode("<br>", $Validator->messages()->all());
			return false;
        }
        return true;
    }
}
