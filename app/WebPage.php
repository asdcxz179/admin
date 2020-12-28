<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WebPage extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
	protected $table = 'web_page';
    protected $fillable = [
        'icon', 'title','content',
    ];
}
