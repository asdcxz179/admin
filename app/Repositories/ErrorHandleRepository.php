<?php

namespace App\Repositories;
use Log;

Trait ErrorHandleRepository
{
 	public function ReturnError($error,$line){
 		Log::debug(get_class($this)."::$line::".trans($error));
 		return trans($error);
 	}
}
