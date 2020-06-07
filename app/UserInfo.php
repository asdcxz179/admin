<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class UserInfo extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	protected $table = 'users_info';
    protected $fillable = [
        'key', 'value','user_id',
    ];
}
