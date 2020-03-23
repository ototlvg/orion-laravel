<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_titles';
    protected $hidden = [
        'updated_at','created_at'
    ];
}
