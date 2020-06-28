<?php

namespace App\Imports;

use App\InterValidez;
use Maatwebsite\Excel\Concerns\ToModel;

class InterpretacionesValidezImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new InterValidez([
            'escala'    => $row[1],
            'nivel' => $row[2],
            'identificador'    => $row[3],
            'puntuacion' => $row[4],
            'utilidad' => $row[5],
            'elevacion' => $row[6],
            'interpretacion' => $row[7],
        ]);
    }
}
