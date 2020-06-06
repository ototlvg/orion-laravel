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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/loginadmin', 'AuthController@login');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');

Route::post('/decrypt', 'PatientController@cryptProbe');

//Route::get('/getquestions', 'PatientController@getQuestions');
Route::get('/getsections', 'PatientController@getSections');
Route::get('/getquestions', 'PatientController@getQuestions');
Route::get('/getpersonal', 'PatientController@getPersonal');
Route::post('/saveanswer', 'PatientController@saveAnswer');
Route::post('/login', 'PatientController@login');
Route::get('/createsections', 'PatientController@createSections');

Route::resource('/register', 'PatientRegisterController');


// Pruebas
Route::get('/probe', 'PatientController@probe');
Route::get('/newrecords', 'PatientController@newRecords');

Route::group(['prefix' => 'admin'], function(){
//    Route::get('crud', 'Admin\ResultsController@index')->name('results.index'); // El mw que comprueba si el usuario ya contesta la encuesto esta declarado en el Controller ANTES ERA POST
    Route::get('crud/search', 'Admin\PatientCRUDController@search');
    Route::resource('crud', 'Admin\PatientCRUDController');
    Route::get('mmpi/basica/{patient_id}', 'Admin\PatientEvaluationController@basica');
});

