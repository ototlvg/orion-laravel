<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;
use App\Result;
use App\Patient;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

        // Si de plano no tiene permiso para acceder
        if(!Patient::find($decrypted)->survey_available){
            return response()->json([1,1,1], 201);
        }

        // Si este paciente no tiene ningun record en la tabla, significa que no ha creado sections
        if(Result::where('patient_id',$decrypted)->first() == null){
            return response()->json([3.3,3.3], 201);
        }

        $actualSurvey=Result::where('patient_id',$decrypted)->max('survey');

        //
        $countRecords= Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->get()->count();
        if($countRecords != 567){
            return response()->json([4.1,4.1], 201);
        }
        //

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

        if(array_sum($status)==sizeof($status)){
            return response()->json([1,1,1,1], 201);
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
        $actualSurvey=Result::where('patient_id', $patient_id)->max('survey');
        return Result::where('patient_id',$patient_id)->where('survey',$actualSurvey)->with('question')->paginate($this->paginadoItems);
        // Original
//        $patient_id = Crypt::decrypt($request->get('id'));
//        $actualSurvey=Result::where('patient_id', $patient_id)->max('survey');
//        return Result::where('patient_id',$patient_id)->with('question')->paginate($this->paginadoItems);
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

//        $pid= $request->get('pid');
//        $x= Result::where('patient_id',$pid)->get();
//        return $x->count();

        $countRecords= Result::where('patient_id',14)->where('survey', 1)->get()->count();
        return response()->json($countRecords, 201);
//        if($countRecords != 567){
//            return response()->json([3.3,3.3], 201);
//        }

//        for ($i=1; $i<=567; $i++){
//            DB::table('results')->insertGetId(
//                [
//                    'patient_id' => 14,
//                    'question' => $i,
//                    'answer' => null,
//                    'survey' => 1
//                ]
//            );
//        }
//
//        return response()->json('Exito', 201);
    }

    public function newRecords(Request $request)
    {
        for ($i=1; $i<=567; $i++){
            $r= new Result;
            $r->patient_id= 14;
            $r->question=$i;
            $r->survey=3;
            $r->save();
        }

        return response()->json($r, 201);
    }

    public function createSections(Request $request)
    {

        $patient_id= Crypt::decrypt($request->get('patient_id'));

        if(!Patient::find($patient_id)->survey_available){
            return response()->json([1,1,1], 201);
        }

        // Si este paciente no tiene ningun record en la tabla, significa que no ha creado sections
        if(!Result::where('patient_id',$patient_id)->first()==null){
            return response()->json([3.3,3.3], 201);
        }


        for ($i=1; $i<=567; $i++){
            DB::table('results')->insertGetId(
                [
                    'patient_id' => $patient_id,
                    'question' => $i,
                    'answer' => null,
                    'survey' => 1
                ]
            );
        }

        return response()->json(1, 201);

    }
}
