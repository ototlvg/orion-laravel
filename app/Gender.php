<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'gender';
    protected $hidden = [
        'updated_at','created_at', 'updated_at'
    ];
}
