<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Contact extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'contact';
    protected $fillable = [
        'contact_title','contact_email','contact_name','contact_content'
    ];
}
