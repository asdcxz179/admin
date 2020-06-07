<?php

namespace App\Repositories;


/**
 * Class RestfulRepository.
 */
Trait RestfulRepository
{

	public $status 	=	'error';
	public $msg 	=	'';
	public $status_code 	=	200;
    public $data    =   [];
    public $error_code;
    public $header;
    /**
     * @return string
     *  Return the model
     */
    public function ReturnHandle(){
        $json   =   [
                            'status'    =>  $this->status,
                            'message'   =>  $this->msg,
                        ];
        if($this->status!='success' && $this->error_code){
            $json['error_code']     =   $this->error_code;
        }
        if($this->data){
            $json['data']   =   $this->data;
        }
        $response   =   response()->json($json, $this->status_code);
        if($this->header){
            $response   =   $response->withHeaders($this->header);
        }
    	return $response;
    }
}
