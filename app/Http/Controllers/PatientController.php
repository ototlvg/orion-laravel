<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;
use App\Result;
use App\Patient;

use App\CustomClass\StatusQuestion;

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
//    public function getSectionsOld(Request $request)
//    {
//        $decrypted = Crypt::decrypt($request->get('patient_id'));
//
//        // Si de plano no tiene permiso para acceder
//        if(!Patient::find($decrypted)->survey_available){
//            return response()->json([1,1,1], 201);
//        }
//
//        // Si este paciente no tiene ningun record en la tabla, significa que no ha creado sections
//        if(Result::where('patient_id',$decrypted)->first() == null){
//            return response()->json([3.3,3.3], 201);
//        }
//
//        $actualSurvey=Result::where('patient_id',$decrypted)->max('survey');
//        //
//        $countRecords= Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->get()->count();
//        if($countRecords != 567){
//            return response()->json([4.1,4.1], 201);
//        }
//        //
//
//        $status= [];
//        $pagesNumber= Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->paginate($this->paginadoItems)->lastPage();
//
//        for ($i=1; $i<=$pagesNumber; $i++){
//            $currentPage= $i;
//            Paginator::currentPageResolver(function () use ($currentPage) {
//                return $currentPage;
//            });
//
//            $sizeofPaginate= sizeof(Result::where('patient_id',$decrypted)->where('survey', $actualSurvey)->paginate($this->paginadoItems)->WhereNull('answer'));
//            if($sizeofPaginate == 0){ // Si el $sizeofPaginate es igual a 0, significa que en la seccion analizada no hay ningun null, la unica forma que pase eso, es que el paciente ya haya contestado todas las preguntas
//                // Retornar un 1 Significa que este Section no tiene ningun null
//                // 1 significa que todas las preguntas estan contestadas
//                array_push($status,1);
//            }else{
//                // 0 significa que esta seccion tiene null
//                array_push($status,0);
//            }
//        }
//
//        if(array_sum($status)==sizeof($status)){
//            return response()->json([1,1,1,1], 201);
//        }
//
//        return $status;
//    }

//    public function cryptProbe(Request $request)
//    {
//        $decrypted = Crypt::decrypt($request->get('value'));
//        $x= $decrypted;
//        return response()->json($x, 201);
//    }

//    public function getQuestions(Request $request)
//    {
//        $patient_id = Crypt::decrypt($request->get('id'));
//        $actualSurvey=Result::where('patient_id', $patient_id)->max('survey');
//        return Result::where('patient_id',$patient_id)->where('survey',$actualSurvey)->with('question')->paginate($this->paginadoItems);
//        // Original
////        $patient_id = Crypt::decrypt($request->get('id'));
////        $actualSurvey=Result::where('patient_id', $patient_id)->max('survey');
////        return Result::where('patient_id',$patient_id)->with('question')->paginate($this->paginadoItems);
//    }

//    public function saveAnswer(Request $request)
//    {
//        $patient_id = Crypt::decrypt($request->get('patient'));
//        $checkLastSection= $request->get('checkLastSection');
//        $completed_surveys= Crypt::decrypt($request->get('completedSurveys'));
//        $survey_available= Crypt::decrypt($request->get('surveyAvailable'));
//        $questionid= $request->get('id');
//        // Ordenara todas los results en un arreglo, el primer valor del arreglo sera el record con la columna survey mas alta
////        $result= Result::where('patient_id', $patient_id)->where('question', $request->get('id'))->where('survey',1)->orderBy('survey', 'desc')->first();
//        $result= Result::where('patient_id', $patient_id)->where('question', $questionid)->where('survey',$completed_surveys+1)->orderBy('survey', 'desc')->first();
////        return $result;
//        $result->answer= $request->get('answer');
////        if($result->save()){
//        if($result->save()){
//
//            if($checkLastSection){
//                $x=Result::where('patient_id',$patient_id)->where('survey', $completed_surveys+1)->WhereNull('answer')->get();
//                if(count($x) == 0){
////                    Aqui pon el codigo para actualizar los registros de encuesta contestada
//                    $pf= Patient::find($patient_id);
//                    $pf->survey_available=0;
//                    $csn= $pf->completed_surveys;
//                    $pf->completed_surveys= $csn+1;
//                    $pf->save();
//                }
//            }
//
//            return response()->json($result, 201);
//        }
////        return response()->json($result, 201);
//
//        // Codigo este
////        $patient_id = Crypt::decrypt($request->get('patient'));
////        return $patient_id;
////        $result= Result::where('patient_id', $patient_id)->update(['answer' => null]);
//
////        $result= Result::where('patient_id', $patient_id)->where('question', $request->get('id'))->first();
////        $result->answer= $request->get('answer');
////        $result->save();
////        return response()->json($result, 201);
//    }

    public function login(Request $request)
    {
        $patient = Patient::where('code', $request->get('code'))->first();
        if(empty($patient)){
            return response()->json('No existe',404);
        }
        return response()->json($patient,201);
    }

    public function getSections(Request $request)
    {
//        return response()->json([1,1,0],201);
//        $userid= 27;
//        $user = auth('patient')->user(); // Esto ya funciona, recuerda poner el token en el Header no en el body
//        return response()->json($user,201);
//        return response()->json(,201);

        $code = $request->get('code');

        $patient = Patient::where('code', $code)->first();

        $userid= $patient->id;
        $completedSurveys = $patient->completed_surveys;
        $surveyAvailable = $patient->survey_available;
        define("numberOfQuestions", 567);
//        return numberOfQuestions;

        // Si el Patient no tiene la encuesta disponible se retorna lo siguiente
        if($surveyAvailable == 0){
            return response()->json([1,1,1], 201);
        }

        // La encuesta actual siempre sera mayor en 1 al $completedSurveys siempre
        // y cuando el Patient este autorizado a contestar la encuesta
        $actualSurvey = $completedSurveys+1;


//        $results= Result::orderBy('question', 'ASC')->where('patient_id', $userid)->get();
        $results= Result::select('question')->orderBy('question', 'ASC')->where('patient_id', $userid)->where('survey', $actualSurvey)->get();
//        $results= Result::where('patient_id', $userid)->where('survey', 1)->get();
//        return $results;

        $questionsAvailable = [];
        foreach ($results as $result){
            array_push($questionsAvailable, $result->question);
        }

//        return $questionsAvailable;
//        return $questionsAvailable;
        $statusSection = [];

        // Nuevo Bug -  Originalmente este codigo estaba aqui
//        if($results->isEmpty()){
//            for($i=0; $i<$this->paginadoItems; $i++){
//                array_push($statusSection, 0);
//            }
//            return response()->json($statusSection, 201);
//        }

        $checkNumberOfSections = numberOfQuestions/$this->paginadoItems;
        $isInt= is_int($checkNumberOfSections); // Retorna true si es un numero entero

        $numberOfSections = 0;
        $numberOfSections = $isInt ? $checkNumberOfSections : ceil($checkNumberOfSections);
//        return $numberOfSections;


        // Nuevo Bug - Este codigo lo movi para aca
        if($results->isEmpty()){
            for($i=0; $i<$numberOfSections; $i++){
                array_push($statusSection, 0);
            }
            return response()->json($statusSection, 201);
        }
        //


        $i=0;
        $section=1;
        $flagQuestion=0;
        $completeSection= true;
        for($i=0; $i<$numberOfSections; $i++){

            if($i==($numberOfSections-1) && !$isInt){
//                $intSections = $numberOfSections-1;
//                $intTotalQuestions = $this->paginadoItems*$intSections;
//                $overQuestions= numberOfQuestions-$intTotalQuestions;
//                $finalCalculate= $flagQuestion+$overQuestions;
//                $questions = range($flagQuestion+1, $finalCalculate,1);
                $questions = range($flagQuestion+1, 567,1);
//                return $questions;
            }else{
                $questions = range($flagQuestion+1, $this->paginadoItems*$section,1);
            }
//            return $questions;
            foreach($questions as $question){
                $questionExists = in_array($question, $questionsAvailable);
                $flagQuestion++;
//                $completeSection = true;
//                return $flagQuestion;
                if(!$questionExists){
                    $flagQuestion= end($questions);
                    $completeSection=false;
                    break;
                }
            }

//            if($section==4){
//                return $questions;
//            }

            if($completeSection){
                array_push($statusSection,1);
            }else{
                array_push($statusSection,0);
            }
            $completeSection=true;
            $section++;
        }

        return $statusSection;
    }

    public function getSectionData(Request $request)
    {
//        return response()->json($request->get('code'),201);
        // Recuerda que en el link se pone ?page=2 por ejemplo y automaticamente la funcion
        // paginate() toma el valor que se envia

//        return $questionsOfSurvey;
        $code = $request->get('code');
        $patient = Patient::where('code', $code)->first();

        $surveyAvailable = $patient->survey_available;

        if($surveyAvailable == 0){
            return response()->json('La encuesta no esta disponible',409);
        }

        $questionsOfSurvey = Question::paginate($this->paginadoItems);

        $userid = $patient->id;
        $actualSurvey = ($patient->completed_surveys) + 1;
        $page = $request->get('page');

        $div = 567/$this->paginadoItems;
        $isInt= is_int($div);
        $numberOfSections = ceil($div);

        if($numberOfSections == $page && !$isInt){
            $intPageQuestions = ($page-1)*$this->paginadoItems;
            $start = $intPageQuestions+1;
            $final = 567;
        }else{
            $start = ($page * $this->paginadoItems) - ($this->paginadoItems-1);
            $final = $page * $this->paginadoItems;
        }
        $questions = range($start, $final,1);

        $results = Result::where('patient_id', $userid)->where('survey',$actualSurvey)->where('question', '>=', $start )->where('question', '<=', $final)->orderBy('question', 'ASC')->get();
        $questionsAnswered = [];

        $final = [];
        foreach ($results as $result){
            array_push($questionsAnswered,$result->question);
        }

        if($results->isEmpty()){
            foreach($questions as $question){
                $sq = (object) ['question' => $question, 'answered' => false, 'survey' => $actualSurvey];
                array_push($final, $sq);
            }
        }else{
            $flagRealQuestions = 0;
            for($i=0; $i<sizeof($questions); $i++){
                if(in_array($questions[$i], $questionsAnswered)){
                    $sq = (object) ['question' => $questions[$i], 'answered' => true, 'survey' => $actualSurvey, 'answer' => $results[$flagRealQuestions]->answer];
                    $flagRealQuestions++;
                }else{
                    $sq = (object) ['question' => $questions[$i], 'answered' => false, 'survey' => $actualSurvey, 'answer' => null];
                }
                array_push($final, $sq);
            }
        }

        $obj = new StatusQuestion();
        $obj->questions = $questionsOfSurvey;
        $obj->sectionStatus = $final;

        return response()->json($obj, 201);
    }

//    public function getStatusQuestionsOfSection(Request $request)
//    {
//        $userid = 27;
//        $actualSurvey = 1;
//        $page = $request->get('page');
//
//        $div = 567/$this->paginadoItems;
//        $isInt= is_int($div);
//        $numberOfSections = ceil($div);
//
//        if($numberOfSections == $page && !$isInt){
//            $intPageQuestions = ($page-1)*$this->paginadoItems;
//            $start = $intPageQuestions+1;
//            $final = 567;
//        }else{
//            $start = ($page * $this->paginadoItems) - ($this->paginadoItems-1);
//            $final = $page * $this->paginadoItems;
//        }
//        $questions = range($start, $final,1);
//
//        $results = Result::where('patient_id', $userid)->where('survey',$actualSurvey)->where('question', '>=', $start )->where('question', '<=', $final)->orderBy('question', 'ASC')->get();
//        $questionsAnswered = [];
//
//        $final = [];
//        foreach ($results as $result){
//            array_push($questionsAnswered,$result->question);
//        }
//
//        if($results->isEmpty()){
//            foreach($questions as $question){
//                $sq = (object) ['question' => $question, 'answered' => false, 'survey' => $actualSurvey];
//                array_push($final, $sq);
//            }
//        }else{
//            for($i=0; $i<sizeof($questions); $i++){
//                if(in_array($questions[$i], $questionsAnswered)){
//                    $sq = (object) ['question' => $questions[$i], 'answered' => true, 'survey' => $actualSurvey];
//                }else{
//                    $sq = (object) ['question' => $questions[$i], 'answered' => false, 'survey' => $actualSurvey];
//                }
//                array_push($final, $sq);
//            }
//        }
//
//        return $final;
//    }


    public function saveAnswers(Request $request)
    {
//        return $request->get('data');
//        $lastSection = $request->get('lastSection') ? 'Estamos en la ultimaa seccion' : 'Aun no estamos en la ultima seccion';

//        return response()->json($request->get('code'),201);

        $code = $request->get('code');
        $patient = Patient::where('code', $code)->first();
        $surveyAvailable = $patient->survey_available;

//        return response()->json('La encuesta no esta disponible',409);
        if($surveyAvailable == 0){
            return response()->json('La encuesta no esta disponible',409);
        }

        $userid = $patient->id;
        $survey = ($patient->completed_surveys) + 1;

        $answers = $request->get('data');

        $lastSection = $request->get('lastSection');

        $firstQuestion = $answers[0]['question'];
        $lastQuestion  = end($answers)['question'];


        $results = Result::where('patient_id', $userid)->where('survey', $survey)->where('question', '>=', $firstQuestion )->where('question', '<=', $lastQuestion)->orderBy('question', 'ASC')->get();
        // Cada elemento de $resultsInDB representa una pregunta que ya esta contestada en la base de datos
        $resultsInDB = [];

        foreach($results as $result){
            array_push($resultsInDB, $result->question);
        }

//        return $resultsInDB;

//        return $answers;



        if(empty($resultsInDB)){
            $m = 'Ninguna respuesta existia en la base de datos, todo se agrego correctamente';
            foreach ($answers as $answer) {
                if(!$answer['answered']){
                    $r = new Result();
                    $r->patient_id = $userid;
                    $r->question = $answer['question'];
                    $r->answer = $answer['answer'];
                    $r->survey = $survey;
                    $r->save();
                }
            }
//            return response()->json(,201);

        }else{
            $m = 'Todas las respuestas enviadas ya existen en la base de datos, no se agrego nada nuevo';
            foreach ($answers as $answer){
                if(!in_array($answer['question'], $resultsInDB)){
                    $r = new Result();
                    $r->patient_id = $userid;
                    $r->question = $answer['question'];
                    $r->answer = $answer['answer'];
                    $r->survey = $survey;
                    $r->save();
                    $m = 'Ya existian algunas respuestas, pero habian respuestas nuevas y han sido agregados a la base de datos';
                }
            }
        }


        if($lastSection){
            $sizeResults= Result::where('patient_id',$userid)->where('survey', $survey)->count();

            if($sizeResults){
                $user = Patient::find($userid);
                $user->completed_surveys = $survey;
                $user->survey_available = false;
                $user->save();
                return $user;
            }

        }

        return response()->json($m,201);



//        throw new \Exception('Error magnetico');
    }

    public function me()
    {
        return response()->json(auth('patient')->user());
    }

    public function getPersonal(Request $request)
    {
        // ESTE SE USA SOLO PARA EL FRONT-END
        $id= Crypt::decrypt($request->get('id'));
        $p= Patient::find($id);
        unset($p->code);
        $p->completed_surveys= encrypt($p->completed_surveys);
        $p->survey_available= encrypt($p->survey_available);
//        unset($p->completed_surveys);
//        unset($p->survey_available);
        unset($p->type  );
        return response()->json($p, 201);
    }

    public function probe(Request $request)
    {
        return response()->json('Hola mundo', 201);
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
