<?php

namespace App\Imports;

use App\Interpretacion;
use Maatwebsite\Excel\Concerns\ToModel;

class InterpretacionesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Interpretacion([
            'escala'    => $row[1],
            'nivel' => $row[2],
            'interpretacion' => $row[3],
        ]);
    }
}
