<?php

namespace App\Http\Controllers;

use App\Result;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    var $results;

    private function retornar(){
        $elargs = func_get_args();
        $tipo= func_get_arg(0);
        $removeFirstElement= array_shift($elargs); // Retorna true||false
        $value=0;
        if($tipo){
            foreach ($elargs as $answerOfQuestion){
                $value+= $this->results[$answerOfQuestion-1]->answer;
            }
        }else{
            foreach ($elargs as $answerOfQuestion){
                $value+= !$this->results[$answerOfQuestion-1]->answer;
            }
        }
        return $value;
    }

    public function prueba()
    {
//        $this->results= Result::where('patient_id',1)->get();
//        $t= $this->retornar(true, 83);
//        $f= $this->retornar(false,16,29,41,51,77,93,102,107,123,139,153,183,203,232,260);
//        return $f;
        return round(13.6, 0, PHP_ROUND_HALF_UP);

//        return response()->json($this->retornar(true,5,6,7),201);

//        $r= Result::where('patient_id',1)->get();
//        return (!$r[0]->answer)+$r[1]->answer;

    }
}
