<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interpretacion extends Model
{
    protected $table= "interpretaciones";
    public $timestamps = false;
    protected $fillable= ['escala','nivel','interpretacion'];
}
