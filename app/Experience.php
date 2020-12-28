<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Experience extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table = 'experience';
    protected $fillable = [
        'job_title','job_content','job_start_date','job_end_date','status','uuid','job_company'
    ];
}
