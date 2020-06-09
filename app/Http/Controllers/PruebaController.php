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

    private function verdadero($elargs){
//        $elargs = func_get_args();
        if($elargs[0] == 0){
            return 0;
        }
        $value=0;
        foreach ($elargs as $answerOfQuestion){
            $value+= $this->results[$answerOfQuestion-1]->answer;
        }
        return $value;
    }

    private function falso($elargs){
//        $elargs = func_get_args();
        if($elargs[0] == 0){
            return 123;
        }
        $value=0;
        foreach ($elargs as $answerOfQuestion){
            $value+= !$this->results[$answerOfQuestion-1]->answer;
        }
        return $value;
//        return $this->results[0]->answer+$this->results[1]->answer;
//        return $this->results[0];
//        return $numargs;
    }

    public function prueba()
    {
        $this->results= Result::where('patient_id',1)->get();
//        $t= $this->retornar(true, 83);
//        $f= $this->retornar(false,16,29,41,51,77,93,102,107,123,139,153,183,203,232,260);
//        return $f;
//        return round(13.6, 0, PHP_ROUND_HALF_UP);

//        return response()->json($this->retornar(true,5,6,7),201);

//        $r= Result::where('patient_id',1)->get();
//        return (!$r[0]->answer)+$r[1]->answer;

        $escalas = array (
            // -------- Escalas de Validez
            // L - Mentira
            array(0),
            array(16,29,41,51,77,93,102,107,123,139,153,183,203,232,260),
            // F - Infrecuencia
            array(18,24,30,36,42,48,54,60,66,72,84,96,114,138,144,150,156,162,168,180,198,216,228,234,240,246,252,258,264,270,282,288,294,300,306,312,324,336,349,355,361),
            array(6,12,78,90,102,108,120,126,132,174,186,192,204,210,222,276,318,330,343),
            // K - Correccion
            array(83),
            array(29,37,58,76,110,116,122,127,130,136,148,157,158,167,171,196,213,243,267,284,290,330,338,339,341,346,348,356,365),
            // -------- Escalas clinicas
            // Hs - Hipocondriasis
            array(18,28,39,53,59,97,101,111,149,175,247),
            array(2,3,8,10,20,45,47,57,91,117,141,143,152,164,173,176,179,208,224,249,255),
            // D - Depresion
            array(5,15,18,37,38,39,46,56,73,92,117,127,130,146,147,170,175,181,215,233),
            array(2,9,10,20,29,33,37,43,45,49,55,68,75,76,95,109,118,134,140,141,142,143,148,165,178,188,189,212,221,223,226,238,245,248,260,267,330),
            // Hi - Histeria
            array(11,18,31,39,40,44,65,101,166,172,175,218,230),
            array(2,3,7,8,9,10,14,26,29,45,47,58,76,81,91,95,98,110,115,16,124,125,129,135,141,148,151,152,157,159,161,164,167,173,176,179,185,193,208,213,224,241,243,249,253,263,265),
            // Dp - Desviacion psicotica
            array(17,21,22,31,32,35,42,52,54,56,71,82,89,94,99,105,113,195,202,219,225,259,264,288),
            array(9,12,34,70,79,83,95,122,125,129,143,157,158,160,167,171,185,209,214,217,226,243,261,263,266,267),
            // Mf - Masculinidad-femeneidad  -- Si es true retorna los valores para Masculino, si es false retorn valores para gemenino
            true ? array(4,25,62,64,67,74,80,112,119,122,128,137,166,177,187,191,196,205,209,219,236,251,256,268,271) : array(4,25,62,64,67,74,80,112,119,121,122,128,137,177,187,191,196,205,219,236,251,256,271),
            true ? array(1,19,26,27,63,68,69,76,86,103,104,107,120,121,132,133,163,184,193,194,197,199,201,207,231,235,237,239,254,257,272) : array(1,19,26,27,63,68,69,76,86,103,104,107,120,132,133,163,166,184,196,194,197,199,201,207,209,231,235,237,239,254,257,268,272),
            // Pa - Paranoia
            array(16,17,22,23,24,42,99,113,138,144,145,146,162,234,259,271,277,285,305,301,333,334,336,355,361),
            array(81,95,98,100,104,110,244,255,266,283,284,286,297,314,315),
            // Pt - Psicastenia
            array(11,16,23,31,38,56,65,73,82,89,94,130,147,170,175,196,218,242,273,275,277,285,289,301,302,304,308,309,310,313,316,317,320,325,326,327,328,329,331),
            array(3,9,33,109,140,165,174,293,321),
            // Es - Esquizofrenia
            array(16,17,21,22,23,31,32,35,38,42,44,46,48,65,85,92,138,145,147,166,168,170,180,182,190,218,221,229,233,234,242,247,252,256,268,273,274,277,279,281,287,291,292,296,298,299,303,307,311,316,319,320,322,323,325,329,332,333,355),
            array(6,9,12,34,90,91,106,165,177,179,192,210,255,276,278,280,290,295,343),
            // Ma - Hipomania
            array(13,15,21,23,50,55,61,85,87,98,113,122,131,145,155,168,169,182,190,200,205,206,211,212,218,220,227,229,238,242,244,248,250,253,269),
            array(88,93,100,106,107,136,154,158,167,243,263),
            // Is - Introversia social
            array(34,56,70,100,104,110,127,135,158,161,167,185,215,243,251,265,275,284,289,296,302,308,326,337,338,347,348,351,352,357,364,367,368,369),
            array(25,32,49,79,86,106,112,131,181,189,207,209,231,237,255,262,267,280,321,328,335,340,342,344,345,350,353,354,358,359,360,362,363,366,370),

        );
        $puntuacionesCrudas= [];
        for($i=0; $i<sizeof($escalas); $i++){
            $v= $this->verdadero($escalas[$i]);
            $f= $this->falso($escalas[$i+1]);
            array_push($puntuacionesCrudas, ($v+$f));
            $i= $i+1;
        }
        return $puntuacionesCrudas;
    }
}
