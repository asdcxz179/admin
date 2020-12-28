<?php

namespace App\Repositories;
use App\WebPage;

/**
 * Class WebPageRepository.
 */
class WebPageRepository
{
    private $webs;
	private $select 	=	['page_icon','page_title','page_content'];

	public function __construct(WebPage $WebPage){
		$this->webpage 	=	$WebPage;
	}

	public function SetSelect(){
		return $this->webpage->select($this->select);
	}

	public function SetWhereIn($page_titles){
		return $this->webpage->whereIn('page_title',$page_titles);
	}

	public function GetWabPage($page_titles=[]){
		$this->webpage 	=	$this->SetSelect();
		if($page_titles){
			$this->webpage =	$this->SetWhereIn($page_titles);
		}
		return $this->webpage->get()->keyBy('page_title');
	}

}
