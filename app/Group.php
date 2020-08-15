<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Group extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table = 'group';
    protected $fillable = [
        'name',
    ];
}
