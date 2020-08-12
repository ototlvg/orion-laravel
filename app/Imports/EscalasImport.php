<?php

namespace App\Imports;

use App\Escala;
use Maatwebsite\Excel\Concerns\ToModel;

class EscalasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Escala([
            'id'     => $row[0],
            'escala'    => $row[1],
            'nombre'    => $row[2],
            'tipo'      => $row[3],
        ]);
    }
}
