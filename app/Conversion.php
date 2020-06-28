<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    public $timestamps = false;
    protected $table='conversiones';
    protected $fillable = ['id','sexo','escala','puntuacion_cruda','puntuacion_t'];
}
