<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterValidez extends Model
{
    protected $table="interpretaciones_validez";
    public $timestamps = false;
    protected $fillable= ['escala','nivel','identificador','puntuacion','utilidad','elevacion','interpretacion'];
}
