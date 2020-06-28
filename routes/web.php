<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('prueba');
//});

Route::get('/energia', 'PruebaController@prueba');
Route::get('/archivos', 'PruebaController@excelSubir');
Route::post('/archivos', 'PruebaController@excel')->name('subir.excel');
Route::get('/pdf', 'PruebaController@pdf');
Route::get('/{any}', 'SpaController@index')->where('any', '.*');

//Route::get('coco', "");

