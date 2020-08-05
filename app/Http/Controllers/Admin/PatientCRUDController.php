<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Result;
use Illuminate\Http\Request;
use App\Patient;

use App\Job;
use App\Marital;
use App\Gender;
use App\CustomClass\Data;
use Illuminate\Support\Facades\DB;

class PatientCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $paginationNumber=10;

    public function index()
    {
//        return response()->json('Hola mundo');
//        sleep(5);
        return Patient::paginate($this->paginationNumber);
//        return Patient::orderBy('id', 'DESC')->paginate($this->paginationNumber);
    }

    public function search(Request $request)
    {
        $search= $request->get('search');
        return Patient::where('name', 'LIKE' ,"%$search%")->orWhere('apaterno', 'LIKE' ,"%$search%")->orWhere('amaterno','LIKE',"%$search%")->paginate($this->paginationNumber);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        sleep(5);

        $patient = Patient::find($id)->delete();
//        return $patient;

        $data = (object) ['message' => 'Usuario eliminado', 'patientid' => $id];
        return response()->json($data, 201);
    }

    public function getFormData(Request $request)
    {
        $jobs= Job::all();
        $genders= Gender::all();
        $marital= Marital::all();
        $data= new Data();
        $data->setJobs($jobs);
        $data->setGenders($genders);
        $data->setMarital($marital);
        return response()->json($data, 201);
    }

    public function reactivate(Request $request)
    {
//        sleep(5);
        $userid = $request->get('id');
        $type = $request->get('type');
        $message = $type == 'activate' ? 'Reactivada' : 'Desactivada';

        $p= Patient::find($userid);
        $completedSurveys = $p->completed_surveys;
        $actualSurvey = $completedSurveys == 0 ? 1 : $completedSurveys;

        if($type == 'activate'){
            $resultsCount = Result::where('patient_id', $userid)->where('survey', $actualSurvey)->count();
            if($resultsCount != 567){
                $data = (object) ['message' => 'El survey actual aun no se finaliza', 'patientid' => $userid, 'survey' => $actualSurvey];
                return response()->json($data, 501);
            }
            $p->survey_available = 1;
            $p->save();
//            return response()->json('La encuesta se reactivo correctamente', 201);
        }


        $data = (object) ['message' => $message, 'patientid' => $userid, 'survey' => $actualSurvey];
        return response()->json($data, 201);

//        return response()->json('Fallo', 500);
    }

    public function teclado(Request $request)
    {
        sleep(5);
        return response()->json($request->name, 201);
    }
}
