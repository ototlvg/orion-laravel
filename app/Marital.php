<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    protected $table = 'marital_status';
    protected $hidden = [
        'updated_at','created_at'
    ];
}
