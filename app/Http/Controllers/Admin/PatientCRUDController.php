<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    var $paginationNumber=8;

    public function index()
    {
//        return response()->json('Hola mundo');

        return Patient::paginate($this->paginationNumber);
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
        //
    }

    public function search(Request $request)
    {
//        $search= Request::get('search');
        $search= $request->get('search');

//        $patients= Patient::where(function($query) use ($search){
//            $query->where('name', 'LIKE' ,$search)->orWhere('apaterno', 'LIKE' ,$search)->orWhere('amaterno','LIKE',$search)->paginate(2);
//        })->paginate(2);
//        return $patients;

        return Patient::where('name', 'LIKE' ,"%$search%")->orWhere('apaterno', 'LIKE' ,"%$search%")->orWhere('amaterno','LIKE',"%$search%")->paginate($this->paginationNumber);
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
        $p= Patient::find($request->get('patient_id'));
        $survey= ($p->completed_surveys)+1;
        for ($i=1; $i<=567; $i++){
            DB::table('results')->insertGetId(
                [
                    'patient_id' => $p->id,
                    'question' => $i,
                    'answer' => null,
                    'survey' => $survey
                ]
            );
        }
        $p->survey_available=1;

        if($p->save()){
            return response()->json('Registros creados', 201);
        }else{
            return response()->json('Fallo', 500);
        }

    }
}
