<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;
use App\Result;
use App\Patient;
//use Request;

class PatientController extends Controller
{

    var $paginadoItems;
    public function __construct()
    {
        $this->paginadoItems= 25; // 25
    }
    public function getSections(Request $request)
    {
        $decrypted = Crypt::decrypt($request->get('patient_id'));
        $status= [];
        $pagesNumber= Result::where('patient_id',$decrypted)->paginate($this->paginadoItems)->lastPage();

        for ($i=1; $i<=$pagesNumber; $i++){
            $currentPage= $i;
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $sizeofPaginate= sizeof(Result::where('patient_id',$decrypted)->paginate($this->paginadoItems)->WhereNull('answer'));
            if($sizeofPaginate == 0){ // Si el $sizeofPaginate es igual a 0, significa que en la seccion analizada no hay ningun null, la unica forma que pase eso, es que el paciente ya haya contestado todas las preguntas
                // Retornar un 1 Significa que este Section no tiene ningun null
                // 1 significa que todas las preguntas estan contestadas
                array_push($status,1);
            }else{
                // 0 significa que esta seccion tiene null
                array_push($status,0);
            }
        }
        return $status;
    }

    public function cryptProbe(Request $request)
    {
        $decrypted = Crypt::decrypt($request->get('value'));
        $x= $decrypted;
        return response()->json($x, 201);
    }

    public function getQuestions(Request $request)
    {
        $patient_id = Crypt::decrypt($request->get('id'));
        $x= $patient_id;
        return Result::where('patient_id',$patient_id)->with('question')->paginate($this->paginadoItems);
    }

    public function saveAnswer(Request $request)
    {

        $patient_id = Crypt::decrypt($request->get('patient'));
        // Ordenara todas los results en un arreglo, el primer valor del arreglo sera el record con la columna survey mas alta
        $result= Result::where('patient_id', $patient_id)->where('question', $request->get('id'))->orderBy('survey', 'desc')->first();
        $result->answer= $request->get('answer');
        $result->save();
        return response()->json($result, 201);

        // Codigo este
//        $patient_id = Crypt::decrypt($request->get('patient'));
//        return $patient_id;
//        $result= Result::where('patient_id', $patient_id)->update(['answer' => null]);

//        $result= Result::where('patient_id', $patient_id)->where('question', $request->get('id'))->first();
//        $result->answer= $request->get('answer');
//        $result->save();
//        return response()->json($result, 201);
    }

    public function login(Request $request)
    {
        $db= Patient::where('code', $request->get('code'))->with('gender')->get();
//        return response()->json(sizeof($db), 201);
        if(sizeof($db)==0){
            return response()->json('No hay nada', 404);
        }else{
//            $db[0]->id= null;
            $db[0]->id_en= encrypt($db[0]->id);
            $db[0]->completed_surveys= encrypt($db[0]->completed_surveys);
            return response()->json($db[0], 201);

        }
    }

    public function getPersonal(Request $request)
    {
        $id= Crypt::decrypt($request->get('id'));
        $p= Patient::find($id);
        unset($p->code);
        unset($p->completed_surveys);
        unset($p->survey_available);
        unset($p->type  );
        return response()->json($p, 201);
    }

    public function probe(Request $request)
    {
        $decrypted = $request->get('patient_id');

        $actualSurvey=Result::where('patient_id',$decrypted)->max('survey');

//        return Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->get();

        $status= [];
        $pagesNumber= Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->paginate($this->paginadoItems)->lastPage();

        for ($i=1; $i<=$pagesNumber; $i++){
            $currentPage= $i;
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $sizeofPaginate= sizeof(Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->paginate($this->paginadoItems)->WhereNull('answer'));
            if($sizeofPaginate == 0){ // Si el $sizeofPaginate es igual a 0, significa que en la seccion analizada no hay ningun null, la unica forma que pase eso, es que el paciente ya haya contestado todas las preguntas
                // Retornar un 1 Significa que este Section no tiene ningun null
                // 1 significa que todas las preguntas estan contestadas
                array_push($status,1);
            }else{
                // 0 significa que esta seccion tiene null
                array_push($status,0);
            }
        }
        return $status;

    }

    public function newRecords(Request $request)
    {
        for ($i=1; $i<=567; $i++){
            $r= new Result;
            $r->patient_id= 3;
            $r->question=$i;
            $r->survey=2;
            $r->save();
        }

        return response()->json($r, 201);
    }
}
