<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Settings extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'system_settings';
    protected $fillable = [
        'key', 'value', 
    ];
}
