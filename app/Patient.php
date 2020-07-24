<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;
use App\Gender;

class Patient extends Authenticatable implements JWTSubject
{

    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $hidden = [
        'password', 'remember_token','updated_at','created_at', 'survey_time'
    ];


    function gender(){
        return $this->belongsTo('App\Gender', 'gender', 'id');
    }

}
