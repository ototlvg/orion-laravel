<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    protected $table="escalas";
    public $timestamps = false;
    protected $fillable= ['escala','nombre','tipo'];
}
