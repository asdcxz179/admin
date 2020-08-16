<?php

namespace App\Repositories;
use Log;

Trait ErrorHandleRepository
{
 	public function ReturnError($error){
 		$line 	=	(isset(debug_backtrace()[0]['line'])?debug_backtrace()[0]['line']:NULL);
 		Log::debug(get_class($this)."::$line::".trans($error));
 		return trans($error);
 	}
}
