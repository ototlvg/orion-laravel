<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Result extends Model
{
    protected $hidden = [
        'created_at', 'updated_at', 'patient_id',
    ];

    function question(){
        return $this->belongsTo('App\Question', 'question', 'id');
    }
}
