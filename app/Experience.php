<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';
    protected $fillable = [
        'job_title','job_content','job_start_date','job_end_date','status','uuid','job_company'
    ];
}
