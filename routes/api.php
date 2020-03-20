<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/decrypt', 'PatientController@cryptProbe');

//Route::get('/getquestions', 'PatientController@getQuestions');
Route::get('/getsections', 'PatientController@getSections');
Route::get('/getquestions', 'PatientController@getQuestions');
Route::get('/getpersonal', 'PatientController@getPersonal');
Route::post('/saveanswer', 'PatientController@saveAnswer');
Route::post('/login', 'PatientController@login');
// Pruebas
Route::get('/probe', 'PatientController@probe');
Route::get('/newrecords', 'PatientController@newRecords');
