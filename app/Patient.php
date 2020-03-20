<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gender;

class Patient extends Model
{
    protected $hidden = [
        'password', 'remember_token','id','updated_at','created_at', 'survey_time'
    ];


    function gender(){
        return $this->belongsTo('App\Gender', 'gender', 'id');
    }

}
