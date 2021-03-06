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



Route::resource('Register', 'PersonaController');

Route::group(['prefix'=> 'auth'],function(){
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('desarrollador_list', 'LecturaController@DesarrolladoresList');
    Route::get('desarrollador_list/habilidad/{name}', 'LecturaController@DesarrolladoresListHabilidad');
    Route::get('reclutador/{id}','LecturaController@GetReclutador');
    Route::get('desarrollador/{id}','LecturaController@GetDesarrollador');
    Route::post('reclutar/{id}','LecturaController@ReclutarDesarrollador');
    Route::post('observar/{id}','LecturaController@ObservarDesarrollador');
    // Route::post('update/state/{id}','LecturaController@updateDesarrollador');

});
