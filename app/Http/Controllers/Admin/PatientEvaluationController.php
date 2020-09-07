<?php

namespace App\Http\Controllers\Admin;

use App\Escala;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Result;
use http\Env\Response;
use Illuminate\Http\Request;
use App\CustomClass\Obj;
use App\CustomClass\Interpretaciones;
use App\Conversion;
use App\InterValidez;
use App\Interpretacion;

class PatientEvaluationController extends Controller
{
    var $results;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('checkCookie');
        $this->middleware('checkAuth');
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
            return 0;
        }
        $value=0;
        foreach ($elargs as $answerOfQuestion){
            $value+= !$this->results[$answerOfQuestion-1]->answer;
        }
        return $value;
    }

    private function getPuntuacionesT($puntuacionesCrudas, $escala, $sexo){
        // Puntuaciones T
        $puntuacionesT=[];
        $sexo = $sexo==1 ? 1 : 2;
//        $escala=30;
        foreach($puntuacionesCrudas as $pCruda){
            // Si no existe el registro no retorna nada y al querer obtener $pt[0] al estar vacio el index 0, pues da un error
            $pt= Conversion::where('sexo', $sexo)->where('escala', $escala)->where('puntuacion_cruda', $pCruda)->select('puntuacion_t')->get();

            if(empty($pt[0])){
                $puntuacionT= 0;
            }else{
                $puntuacionT= $pt[0]->puntuacion_t;
            }

            array_push($puntuacionesT,$puntuacionT);
            $escala++;
        }
        return $puntuacionesT;
    }

    public function basica($patient_id,$survey)
    {
//        sleep(5);
        $nullRow= Result::where('patient_id',$patient_id)->where('survey', $survey)->WhereNull('answer')->first();
//        return empty($nullRow) ? 'Esta vacio' : 'No esta vacio';
        if(!empty($nullRow)){
            return response()->json('vacio', 201);
        }
        $this->results= Result::where('patient_id',$patient_id)->where('survey',$survey)->get();
//        return $this->results;
        $sexo= Patient::find($patient_id)->gender==1 ? true:false; // $sexo==1 -> Masculino     $sexo==2 ->Femenino
        $escalas = array (
            // -------- Escalas de Validez
            // L - Mentira 1
            array(0),
            array(16,29,41,51,77,93,102,107,123,139,153,183,203,232,260),
            // F - Infrecuencia 2
            array(18,24,30,36,42,48,54,60,66,72,84,96,114,138,144,150,156,162,168,180,198,216,228,234,240,246,252,258,264,270,282,288,294,300,306,312,324,336,349,355,361),
            array(6,12,78,90,102,108,120,126,132,174,186,192,204,210,222,276,318,330,343),
            // K - Correccion 3
            array(83),
            array(29,37,58,76,110,116,122,127,130,136,148,157,158,167,171,196,213,243,267,284,290,330,338,339,341,346,348,356,365),
            // -------- Escalas clinicas
            // Hs - Hipocondriasis
            array(18,28,39,53,59,97,101,111,149,175,247),
            array(2,3,8,10,20,45,47,57,91,117,141,143,152,164,173,176,179,208,224,249,255),
            // D - Depresion
            array(5,15,18,31,38,39,46,56,73,92,117,127,130,146,147,170,175,181,215,233), //--ERROR ENCONTRADO 37-31
            array(2,9,10,20,29,33,37,43,45,49,55,68,75,76,95,109,118,134,140,141,142,143,148,165,178,188,189,212,221,223,226,238,245,248,260,267,330),
            // Hi - Histeria
            array(11,18,31,39,40,44,65,101,166,172,175,218,230),
            array(2,3,7,8,9,10,14,26,29,45,47,58,76,81,91,95,98,110,115,116,124,125,129,135,141,148,151,152,157,159,161,164,167,173,176,179,185,193,208,213,224,241,243,249,253,263,265), //--ERROR ENCONTRADO 116
            // Dp - Desviacion psicopata
            array(17,21,22,31,32,35,42,52,54,56,71,82,89,94,99,105,113,195,202,219,225,259,264,288),
            array(9,12,34,70,79,83,95,122,125,129,143,157,158,160,167,171,185,209,214,217,226,243,261,263,266,267),
            // Mf - Masculinidad-femeneidad  -- Si es true retorna los valores para Masculino, si es false retorn valores para gemenino
            $sexo ? array(4,25,62,64,67,74,80,112,119,122,128,137,166,177,187,191,196,205,209,219,236,251,256,268,271) : array(4,25,62,64,67,74,80,112,119,121,122,128,137,177,187,191,196,205,219,236,251,256,271),
            $sexo ? array(1,19,26,27,63,68,69,76,86,103,104,107,120,121,132,133,163,184,193,194,197,199,201,207,231,235,237,239,254,257,272) : array(1,19,26,27,63,68,69,76,86,103,104,107,120,132,133,163,166,184,193,194,197,199,201,207,209,231,235,237,239,254,257,268,272), //--ERROR ENCONTRADO 196 193
            // Pa - Paranoia
            array(16,17,22,23,24,42,99,113,138,144,145,146,162,234,259,271,277,285,305,307,333,334,336,355,361),
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
            array(31,56,70,100,104,110,127,135,158,161,167,185,215,243,251,265,275,284,289,296,302,308,326,337,338,347,348,351,352,357,364,367,368,369),
            array(25,32,49,79,86,106,112,131,181,189,207,209,231,237,255,262,267,280,321,328,335,340,342,344,345,350,353,354,358,359,360,362,363,366,370),
        );
        $puntuacionesCrudas= [];
        for($i=0; $i<sizeof($escalas); $i++){
            $v= $this->verdadero($escalas[$i]);
            $f= $this->falso($escalas[$i+1]);
            array_push($puntuacionesCrudas, ($v+$f));
            $i= $i+1;
        }
//        return $puntuacionesCrudas;

        $factorKAgregado=[]; // [.5K, .4K, K, K,.2K]
        foreach ([0.5,0.4,1,1,0.2] as $decimal){
            array_push($factorKAgregado, round(($puntuacionesCrudas[2]*$decimal), 0, PHP_ROUND_HALF_UP));
        }

        ///////
        $puntuacionesCompletas= $puntuacionesCrudas;
        ///////

        $puntuacionCrudaConK= [];
        $k=0;
        foreach ([3,6,9,10,11] as $pc){
            array_push($puntuacionCrudaConK, $puntuacionesCrudas[$pc]+$factorKAgregado[$k]);

            ///
            $puntuacionesCompletas[$pc] = $puntuacionCrudaConK[$k];
            ///

            $k++;
        }

        $obj= new Obj();
        $obj->survey= $survey;

        // Datos de las Escalas
        $escalasdb= Escala::where('tipo',1)->get();
        $obj->escalas= $escalasdb;

        $obj->puntuacionesCrudas= $puntuacionesCrudas;
        $obj->factorKAgregado= $factorKAgregado;
        $obj->puntuacionCrudaConK= $puntuacionCrudaConK;

//        return $escalasdb;

        ///
        $obj->puntuacionesCompletas= $puntuacionesCompletas;
        ///

//        return response()->json($obj, 201);

//        $puntuacionesCompletas= $puntuacionesCrudas;
//        $puntuacionesCompletas[3] = $puntuacionCrudaConK[0];
//        $puntuacionesCompletas[6] = $puntuacionCrudaConK[1];
//        $puntuacionesCompletas[9] = $puntuacionCrudaConK[2];
//        $puntuacionesCompletas[10]= $puntuacionCrudaConK[3];
//        $puntuacionesCompletas[11]= $puntuacionCrudaConK[4];



        // Puntuaciones T
        $puntuacionesT=[];
        $sexo = $sexo ? 1 : 2;

        //Extra
        $pTv= []; // Puntuaciones T de la Escala de Validez
        $pTc= []; // Puntuaciones T de las Escalas Clinicas
        $puntuacionesT_Clinicas= [];

//        return response()->json($obj, 201);
//        return $puntuacionesCompletas;

        for($i=0; $i<sizeof($puntuacionesCompletas);$i++){
            $flag= $i;

//            if($sexo==2 && $i==7){
//                $i= 43;
//            }

            // Si no existe el registro no retorna nada y al querer obtener $pt[0] al estar vacio el index 0, pues da un error
            $pt= Conversion::where('sexo', $sexo)->where('escala', $i+1)->where('puntuacion_cruda', $puntuacionesCompletas[$flag])->select('puntuacion_t')->get();


//            if($i==43){
////                return $puntuacionesCompletas[$flag];
//            }


            if(empty($pt[0])){
//                return $i;
//                return $sexo;
//                return $puntuacionesCompletas[7];
                $puntuacionT= 0;
            }else{
                $puntuacionT= $pt[0]->puntuacion_t;
            }

            array_push($puntuacionesT,$puntuacionT);

//            if($i==43){
//                $i=$flag;
//            }

            // Extra
            if($i<3){
                array_push($pTv,$puntuacionT);
            }else{
                array_push($pTc,$puntuacionT);
            }

        }
//        return $puntuacionesT;
        $obj->puntuacionesT= $puntuacionesT;

//        return response()->json($obj, 201);


        $objInterpretaciones= new Interpretaciones();

        // Interpretaciones - Escala de validez
        $interValidez= [];
        $pEv=array( // puntuacionesDeEvaluacionEscalaValidez
            array(80,70,79,60,69,50,59,49),
            array(91,71,90,56,70,45,55,44),
            array(71,56,70,41,55,40)
        );
        $i=0;
        for($i=0; $i<3; $i++){ // El 2 antes era sizeof($pTv) - Aqui se obtiene la puntuacion T de la Escala de Validez
            $pt= $pTv[$i];

            $identificador=0;

            if($pt>=$pEv[$i][0]){ // 80
                $identificador= $pEv[$i][0];
            }elseif($pt>=$pEv[$i][1] && $pt<=$pEv[$i][2]){ // 70 - 79
                $identificador= $pEv[$i][1];
            }elseif($pt>=$pEv[$i][3] && $pt<=$pEv[$i][4]){ // 60 - 69
                $identificador= $pEv[$i][3];
            }

            if(!$i==3 && $identificador==0){
                if($pt>=$pEv[$i][5] && $pt<=$pEv[$i][6]){ // 50 - 59 // Este no existe en el ultimo
                    $identificador= $pEv[$i][5];
                }else{
                    $identificador= $pEv[$i][7];
                }
            }else{
                if($identificador==0){
                    $identificador= $pEv[$i][5];
                }
            }

            $iv= InterValidez::where('identificador',$identificador)->get();
            array_push($interValidez, $iv[0]);
        }
//        $obj->interpretacionesEscalaValidez= $interValidez;
        $objInterpretaciones->validez= $interValidez;
//        return $interValidez;
//        return $pTc;

        // Interpretaciones Escalas clinicas
        $interClinicas= [];
        $pEc= array(
            array(76,66,75,56,65,41,55,40),
            array(70,60,69,51,59,41,50,40)
        );
        $i=4;
        $j=0;
        foreach($pTc as $pt){
            $flag= $i;

            if($i==8 && $sexo==2){ // Si es 8!!!
//                $i=44;
                $j=1;
            }

            $identificador=0;
            if($pt>=$pEc[$j][0]){ // 76
                $identificador= !($sexo==2&&$j==1) ? 1 : 6;
            }elseif($pt>=$pEc[$j][1] && $pt<=$pEc[$j][2]){ // 66 - 75
                $identificador= !($sexo==2&&$j==1) ? 2 : 7;
            }elseif($pt>=$pEc[$j][3] && $pt<=$pEc[$j][4]){ // 56 - 65
                $identificador= !($sexo==2&&$j==1) ? 3 : 8;
            }elseif($pt>=$pEc[$j][5] && $pt<=$pEc[$j][6]){ // 41 a 55
//                $identificador= 4;
                $identificador= !($sexo==2&&$j==1) ? 4 : 9;
            }else{
//                $identificador= 5;
                $identificador= !($sexo==2&&$j==1) ? 5 : 10;
            }

//            $ic= Interpretacion::where('escala', $i)->where('nivel', $identificador)->get();
            $ic= Interpretacion::where('escala', $i)->where('nivel', $identificador)->with('nivel')->get();
//            if($ic[0]==0){
//                return $i;
//            }
            if(empty($ic[0])){
                $ic[0]= "Error";
            }
            array_push($interClinicas, $ic[0]);

            if($j==1){
//                $i= $flag;
                $j=0;
            }
            $i++;
        }
//        return $interClinicas;
//        $obj->interpretacionesEscalasClinicas= $interClinicas;
        $objInterpretaciones->clinicas= $interClinicas;

        $obj->interpretaciones= $objInterpretaciones;

        return response()->json($obj, 201);
    }

    public function suplementaria($patient_id, $survey)
    {
//        sleep(5);
        // OJO: el $nullRow solo detecta si hay un null, por lo que el survey si debe de existir, PERO esto solo detecta
        // si ya esta contestado o no, NO detecta si los registros del survey 2 por ejemplo existen
        $nullRow= Result::where('patient_id',$patient_id)->where('survey', $survey)->WhereNull('answer')->first();
//        return empty($nullRow) ? 'Esta vacio' : 'No esta vacio';
        if(!empty($nullRow)){
            return response()->json('vacio', 201);
        }
        $this->results= Result::where('patient_id',$patient_id)->where('survey',$survey)->get();

//        $this->results= Result::where('patient_id',$patient_id)->get();
//        return $this->results;
        $sexo= Patient::find($patient_id)->gender; // $sexo==1 -> Masculino     $sexo==2 ->Femenino
        $escalas = array (
            // A - Ansiedad (0)
            array(31,38,56,65,82,127,135,215,233,243,251,273,277,289,301,309,310,311,325,328,338,339,341,347,390,391,394,400,408,411,415,421,428,442,448,451,464,469),
            array(388),
            // R - Represion (1)
            array(0),
            array(1,7,10,14,37,45,69,112,118,120,128,134,142,168,178,189,197,199,248,255,256,297,330,346,350,353,354,359,363,365,422,423,430,432,449,456,465),
            // Fyo - Fuerza del yo (2)
            array(2,33,45,98,141,159,169,177,179,189,199,209,213,230,245,323,385,406,413,425),
            array(23,31,32,36,39,53,60,70,82,87,119,128,175,196,215,221,225,229,236,246,307,310,316,328,391,394,441,447,458,464,469,471),
            // A-MAC - Alcoholismo de MacAndrew revisada (3)
            array(7,24,36,49,52,69,72,82,84,103,105,113,115,128,168,172,202,214,224,229,238,257,280,342,344,387,407,412,414,422,434,439,445,456,473,502,506,549), //--ERROR HABIA PUESTO 471 EN VEZ DE 473
            array(73,107,117,137,160,166,251,266,287,299,325),
            // Fp (14)
            array(281,291,303,311,317,319,322,323,329,332,333,334,387,395,407,431,450,454,463,468,476,478,484,489,506,516,517,520,524,525,526,528,530,539,540,544,555),
            array(383,404,501),
            // HR - Hostilidad reprimida (4)
            array(67,79,207,286,305,398,471),
            array(1,15,29,69,77,89,98,116,117,129,153,169,171,293,344,390,400,420,433,440,460),
            // Do - Dominancia (5)
            array(55,207,232,245,386,416),
            array(31,52,70,73,82,172,201,202,220,227,243,244,275,309,325,399,412,470,473),
            // Rs - Responsabilidad social (6)
            array(100,160,199,266,440,467),
            array(7,27,29,32,84,103,105,145,164,169,201,202,235,275,358,412,417,418,430,431,432,456,468,470),
            // Dpr - Desajuste profesional (7)
            array(15,16,28,31,38,71,73,81,82,110,130,215,218,233,269,273,299,302,325,331,339,357,408,411,449,464,469,472),
            array(2,3,9,10,20,43,95,131,140,148,152,223,405),
            // GM - Genero masculino (8) || Genero femenino (8)
//            $sexo ? array(8,20,143,152,159,163,176,199,214,237,321,350,385,388,401,440,462,467,474) : array(62,67,119,121,128,203,263,266,353,384,426,449,456,473,552),
//            $sexo ? array(4,23,44,64,70,73,74,80,100,137,146,187,289,331,351,364,392,395,435,438,441,469,471,498,509,519,532,536) : array(1,27,63,68,79,84,105,123,133,155,197,201,220,231,238,239,250,257,264,272,287,406,417,465,477,487,510,511,537,548,550),
            // GM - Genero masculino (8)
            array(8,20,143,152,159,163,176,199,214,237,321,350,385,388,401,440,462,467,474),
            array(4,23,44,64,70,73,74,80,100,137,146,187,289,331,351,364,392,395,435,438,441,469,471,498,509,519,532,536),
            // GF - Genero femenino (9)
            array(62,67,119,121,128,203,263,266,353,384,426,449,456,473,552),
            array(1,27,63,68,79,84,105,123,133,155,197,201,220,231,238,239,250,257,264,272,287,406,417,465,477,487,510,511,537,548,550),
            // EPK - Desorden de estres postraumatico de Keane (10)
            array(16,17,22,23,30,31,32,37,39,48,52,56,59,65,82,85,92,94,101,135,150,168,170,196,221,274,277,302,303,305,316,319,327,328,339,347,349,367),
            array(2,3,9,49,75,95,125,140),
            // EPS - Desorden de estres postraumatico de Schelenger (11)
            array(17,21,22,31,32,37,38,44,48,56,59,65,85,94,116,135,145,150,168,170,180,218,221,273,274,277,299,301,304,305,311,316,319,325,328,377,386,400,463,464,469,471,475,479,515,516,565),
            array(3,9,45,75,95,141,165,208,223,280,372,405,564),
            // Is1 (12)
            array(158,161,167,185,243,265,275,289),
            array(49,262,280,321,342,360), // -ERROR puse 242 en vez de 342
            // Is2 (13)
            array(336,367),
            array(86,340,353,359,363,370),
            // Is3 (14)
            array(31,56,104,110,135,284,302,308,326,328,338,347,348,358,364,368,369),
            array(0),
        );
        $obj= new Obj();
//        unset($obj->factorKAgregado);
//        unset($obj->puntuacionCrudaConK);
//        unset($obj->puntuacionesCrudas);

        // Datos de las Escalas
        $escalasdb= Escala::where('tipo',2)->get();
        $obj->survey= $survey;
        $obj->escalas= $escalasdb;

        $puntuacionesCrudas= [];
        for($i=0; $i<sizeof($escalas); $i++){
            $v= $this->verdadero($escalas[$i]);
            $f= $this->falso($escalas[$i+1]);
            array_push($puntuacionesCrudas, ($v+$f));
            $i= $i+1;
        }
        $obj->puntuacionesCrudas= $puntuacionesCrudas; // Puntuaciones crudas es lo mismo que puntuaciones completas, ya que aqui en ningun momento se agrega el factor K
        $x=[];
//        return $puntuacionesCrudas;
        // Puntuaciones T
        $escala=14;

//        $sexo = $sexo==1 ? 1 : 2;
//        $puntuacionesT=[];
//        foreach($puntuacionesCrudas as $pCruda){
//            // Si no existe el registro no retorna nada y al querer obtener $pt[0] al estar vacio el index 0, pues da un error
//            $pt= Conversion::where('sexo', $sexo)->where('escala', $escala)->where('puntuacion_cruda', $pCruda)->select('puntuacion_t')->get();
//
//            if(empty($pt[0])){
//                $puntuacionT= 0;
//            }else{
//                $puntuacionT= $pt[0]->puntuacion_t;
//            }
//
//            array_push($puntuacionesT,$puntuacionT);
//            $escala++;
//        }
        $puntuacionesT= $this->getPuntuacionesT($puntuacionesCrudas, $escala,$sexo);


//        return $puntuacionesT;
        $obj->puntuacionesT= $puntuacionesT;


        // INVAR
        $invarVerdaderos= array(
            array(3,39),
            array(40,176),
            array(48,184),
            array(83,288),
            array(125,195),
        );
        $invarSumaVerdadores=0;
        for($i=0;$i<sizeof($invarVerdaderos);$i++){
//            return $invarVerdadero[$i][0];
            $valor1= $this->results[($invarVerdaderos[$i][0])-1]->answer;
            $valor2= $this->results[($invarVerdaderos[$i][1])-1]->answer;
//            array_push($x, ($valor1&&$valor2 ? 1 : 0));
            $invarSumaVerdadores+=($valor1&&$valor2 ? 1 : 0);
        }
        $i=0;

        $invarFalsos= array(
            array(9,56),
            array(125,195),
            array(152,464),
            array(165,565),
            array(262,275),
        );
        $invarSumaFalsos=0;
        for($i=0;$i<sizeof($invarFalsos);$i++){
//            return $invarVerdadero[$i][0];
            $valor1= $this->results[($invarFalsos[$i][0])-1]->answer;
            $valor2= $this->results[($invarFalsos[$i][1])-1]->answer;
            $invarSumaFalsos+=(!$valor1&&!$valor2 ? 1 : 0);
        }
        $i=0;

        $invarFalsoVerdadero= array(
            // Azules
            array(90,6),
            array(59,28),
            array(299,31),
            array(265,46), // ----error
            array(280,49),
            array(377,73),
            array(284,81),
            array(105,84),
            array(359,86),
            array(344,103),
            array(374,110),
            array(430,116),

            array(507,136),
            array(185,161),
            array(268,166),
            array(243,167),
            array(467,199),
            array(267,226),
            array(556,290),

            array(515,349),
            array(370,353),
            array(405,372),
            array(562,380),
            array(435,395),
            array(403,396),
            array(485,411),
            array(533,472),
            array(509,491),
            array(520,506),
            array(542,513),

            // Amarillos
            array(6,90),
            array(32,316),
            array(46,265),
            array(81,284),
            array(95,388),
            array(99,138),
            array(110,374),

            array(135,482),
            array(136,507),
            array(161,185),
            array(166,268),
            array(167,243),
            array(196,415),
            array(199,467),
            array(259,333),
            array(290,556),
            array(339,394),

            array(349,515),
            array(350,521),
            array(353,370),
            array(364,554),
            array(369,421),
            array(372,405),
            array(395,435),
            array(396,403),
            array(411,485),
            array(472,533),
            array(506,520),
        );
        $invarSumaFalsosVerdadores=0;
        for($i=0;$i<sizeof($invarFalsoVerdadero);$i++){
//            return $invarVerdadero[$i][0];
            $valor1= $this->results[($invarFalsoVerdadero[$i][0])-1]->answer;
            $valor2= $this->results[($invarFalsoVerdadero[$i][1])-1]->answer;
            $invarSumaFalsosVerdadores+=(!$valor1&&$valor2 ? 1 : 0);
//            $valor1= $this->results[($invarFalsoVerdadero[$i][0])-1];
//            $valor2= $this->results[($invarFalsoVerdadero[$i][1])-1];
//            array_push($x, $valor1);
//            array_push($x, $valor2);
        }
        $i=0;
//        return $invarSumaVerdadores+$invarSumaFalsos+$invarSumaFalsosVerdadores;
//        return $invarSumaFalsosVerdadores;

        $invar= ($invarSumaVerdadores+$invarSumaFalsos+$invarSumaFalsosVerdadores);
        array_push($puntuacionesCrudas, $invar);
        $obj->invar= $invar;


        // INVER
        $inverVerdaderos= array(
            array(3,39),
            array(12,166),
            array(40,176),
            array(48,184),
            array(63,127),
            array(65,95),
            array(73,239),
            array(83,288),
            array(99,314),
            array(125,195),
            array(209,351),
            array(359,367),
            array(377,534),
            array(556,560),
        );
        $inverSumaVerdadores=0;
        for($i=0;$i<sizeof($inverVerdaderos);$i++){
            $valor1= $this->results[($inverVerdaderos[$i][0])-1]->answer;
            $valor2= $this->results[($inverVerdaderos[$i][1])-1]->answer;
            $inverSumaVerdadores+=($valor1&&$valor2 ? 1 : 0);
//            $valor1= $this->results[($inverVerdaderos[$i][0])-1];
//            $valor2= $this->results[($inverVerdaderos[$i][1])-1];
//            array_push($x, $valor1);
//            array_push($x, $valor2);
        }
//        return $inverSumaVerdadores;

        $inverFalsos= array(
            array(9,56),
            array(65,95),
            array(125,195),
            array(140,196),
            array(152,464),
            array(165,565),
            array(262,275),
            array(265,360),
            array(359,367),
        );

        $inverSumaFalsos=0;
        for($i=0;$i<sizeof($inverFalsos);$i++){
            $valor1= $this->results[($inverFalsos[$i][0])-1]->answer;
            $valor2= $this->results[($inverFalsos[$i][1])-1]->answer;
            $inverSumaFalsos+=(!$valor1&&!$valor2 ? 1 : 0);
//            $valor1= $this->results[($inverFalsos[$i][0])-1];
//            $valor2= $this->results[($inverFalsos[$i][1])-1];
//            array_push($x, $valor1);
//            array_push($x, $valor2);
        }
        $inver= $inverSumaVerdadores-$inverSumaFalsos+9;
        array_push($puntuacionesCrudas, $inver);
        $obj->inver= $inver;



        $obj->puntuacionesCompletas= $puntuacionesCrudas; // [A,R,Fyo,A-MAC,Fp,HR,Do,Rs,Dpr,GM,GF,EPK,EPS,Is1,Is2,Is3,INVAR,INVER]

//        $puntuacionesCompletas= $puntuacionesCrudas;
//        $obj->puntuacionesCompletas= $puntuacionesCrudas;


        return response()->json($obj, 201);
    }

    public function contenido($patient_id,$survey)
    {
//        sleep(5);
        $nullRow= Result::where('patient_id',$patient_id)->where('survey', $survey)->WhereNull('answer')->first();
//        return empty($nullRow) ? 'Esta vacio' : 'No esta vacio';
        if(!empty($nullRow)){
            return response()->json('vacio', 201);
        }
        $this->results= Result::where('patient_id',$patient_id)->where('survey',$survey)->get();
//        $this->results= Result::where('patient_id',$patient_id)->get();
        $sexo= Patient::find($patient_id)->gender==1 ? true:false; // $sexo==1 -> Femenino     $sexo==2 ->Masculino
        $escalas= array(
            // ANS - Ansiedad
            array(15,30,31,39,170,196,273,290,299,301,305,339,408,415,463,469,509,556),
            array(140,208,223,405,496),
            // MIE - Miedos
            array(154,317,322,329,334,392,395,397,435,438,441,447,458,468,471,555),
            array(115,163,186,385,401,453,462),
            // OBS - Obsesividad
            array(55,87,135,196,309,313,327,328,394,442,482,491,497,509,547,553),
            array(0),
            // DEP - Depresion
            array(38,52,56,65,71,82,92,130,146,215,234,246,277,303,306,331,377,399,400,411,454,506,512,516,520,539,546,554),
            array(3,9,75,95,388),
            // SAU - Preocupacion por la salud
            array(11,18,28,36,40,44,53,59,97,101,111,149,175,247),
            array(20,33,45,47,57,91,117,118,141,142,159,164,176,179,181,194,204,224,249,255,295,404),
            // DEL - Pensamiento delirante
            array(24,32,60,96,138,162,198,228,259,298,311,316,319,333,336,355,361,466,490,506,543,551),
            array(427),
            // ENJ - Enojo
            array(29,37,116,134,302,389,410,414,430,461,486,513,540,542,548),
            array(564),
            // CIN - Cinismo
            array(50,58,76,81,104,110,124,225,241,254,283,284,286,315,346,352,358,374,399,403,445,470,538),
            array(0),
            // PAS - Practicas antisociales
            array(26,35,66,81,84,104,105,110,123,227,240,248,250,254,269,283,284,374,412,418,419),
            array(266),
            // PTA - Personalidad tipo A
            array(27,136,151,212,302,358,414,419,420,423,430,437,507,510,523,531,535,541,545),
            array(0),
            // BAE - Baja autoestima
            array(70,73,130,235,326,369,376,380,411,421,450,457,475,476,483,485,503,504,519,526,562),
            array(61,78,109),
            // ISO - Incomodidad social
            array(46,158,167,185,265,275,281,337,349,367,479,480,515),
            array(49,86,262,280,321,340,353,359,360,363,370),
            // FAM - Problemas familiares
            array(21,54,145,190,195,205,256,292,300,323,378,379,382,413,449,478,543,550,563,567),
            array(83,125,217,383,455),
            // DTR - Dificultad en el trabajo
            array(15,17,31,54,73,98,135,233,243,299,302,339,364,368,394,409,428,445,464,491,505,509,517,525,545,554,559,566),
            array(10,108,318,521,561),
            // RTR - Rechazo al tratamiento
            array(22,92,274,306,364,368,373,375,376,377,391,399,482,488,491,495,497,499,500,504,528,539,554),
            array(493,494,501),
        );

        // Codigo para checar el numero de reactivos por Escala
//        $arr=[];
//        for ($i=0; $i<sizeof($escalas);$i++){
//            $a= ((sizeof($escalas[$i])==1)&&($escalas[$i][0]==0))? 0 : sizeof($escalas[$i]);
//            $b= ((sizeof($escalas[$i+1])==1)&&($escalas[$i+1][0]==0))? 0 : sizeof($escalas[$i+1]);
//            array_push($arr,$a+$b);
//            $i=$i+1;
//        }
//        return $arr;

        $puntuacionesCrudas= [];
        for($i=0; $i<sizeof($escalas); $i++){
            $v= $this->verdadero($escalas[$i]);
            $f= $this->falso($escalas[$i+1]);
            array_push($puntuacionesCrudas, ($v+$f));
            $i= $i+1;
        }


        // Puntuaciones T
        $escala=30;

//        $sexo = $sexo==1 ? 1 : 2;
//        $puntuacionesT=[];
//        foreach($puntuacionesCrudas as $pCruda){
//            // Si no existe el registro no retorna nada y al querer obtener $pt[0] al estar vacio el index 0, pues da un error
//            $pt= Conversion::where('sexo', $sexo)->where('escala', $escala)->where('puntuacion_cruda', $pCruda)->select('puntuacion_t')->get();
//
//            if(empty($pt[0])){
//                $puntuacionT= 0;
//            }else{
//                $puntuacionT= $pt[0]->puntuacion_t;
//            }
//
//            array_push($puntuacionesT,$puntuacionT);
//            $escala++;
//        }

        $puntuacionesT= $this->getPuntuacionesT($puntuacionesCrudas, $escala,$sexo);



//        return $puntuacionesT;


        $obj= new Obj();
        $obj->survey= $survey;
        // Datos de las Escalas
        $escalasdb= Escala::where('tipo',3)->get();
        $obj->escalas= $escalasdb;

//        $obj->puntuacionesCrudas= $puntuacionesCrudas; // []
        $obj->puntuacionesCompletas= $puntuacionesCrudas; // []
        $obj->puntuacionesT= $puntuacionesT;
        $obj->nota= "Aqui las puntuaciones crudas son iguales a las puntuaciones completas";
        return response()->json($obj, 201);

//        return $puntuacionesCrudas;

    }
}
