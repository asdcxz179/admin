<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'permission';
    protected $fillable = [
        'group_id','role_id','method',
    ];
}
