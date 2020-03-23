<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Marital;
use App\Gender;
use App\CustomClass\Data;
use App\Patient;
use Faker\Factory as Factory;
use Illuminate\Support\Facades\DB;

class PatientRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
//        return $request->get('email');

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'apaterno' => 'required|max:255',
            'amaterno' => 'max:255',
            'gender' => 'required|max:255',
            'marital' => 'required|max:255',
            'birthday' => 'required|max:255',
            'job' => 'required|max:255',
            'email' => 'nullable|max:255|email|unique:patients,email',
        ]);

        $p= new Patient;
        $p->code= Factory::create()->ean8;
        $p->name= $request->get('name');
        $p->apaterno= $request->get('apaterno');
        $p->amaterno= $request->get('amaterno');
        $p->gender= $request->get('gender');
        $p->marital_status= $request->get('marital');
        $p->birthday= $request->get('birthday');
        $p->job= $request->get('job');
        $p->email= $request->get('email');
        $p->type= 1;
        $p->save();


//        for ($i=1; $i<=567; $i++){
//            DB::table('results')->insertGetId(
//                [
//                    'patient_id' => $p->id,
//                    'question' => $i,
//                    'answer' => null,
//                    'survey' => 1
//                ]
//            );
//        }


        return response()->json($p->code, 201);
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
}
