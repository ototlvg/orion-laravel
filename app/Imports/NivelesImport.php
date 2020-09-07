<?php

namespace App\Imports;

use App\Nivel;
use Maatwebsite\Excel\Concerns\ToModel;

class NivelesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Nivel([
            'nivel'    => $row[1],
            'identificador' => $row[2],
        ]);
    }
}
