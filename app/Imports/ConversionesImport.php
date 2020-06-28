<?php

namespace App\Imports;

use App\Conversion;
use Maatwebsite\Excel\Concerns\ToModel;

class ConversionesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Conversion([
//            'id'     => $row[0],
            'sexo'    => $row[1],
            'escala' => $row[2],
            'puntuacion_cruda' => $row[3],
            'puntuacion_t' => $row[4],
        ]);
    }
}
