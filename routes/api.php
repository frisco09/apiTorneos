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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('Users','User\userController',['except'=>['create','edit']]);
Route::resource('Videoconsolas','Videoconsola\videoconsolaController',['only'=>['create','edit','index','show']]);
Route::resource('Videojuegos','Videojuego\videojuegoController',['only'=>['create','edit','index','show']]);
Route::resource('Amistosos','Amistoso\amistosoController',['only'=>['create','edit','index','show']]);
Route::resource('Resultados','Resultado\resultadoController',['only'=>['create','edit','index','show']]);
Route::resource('Salas','Sala\salaController',['only'=>['create','edit','index','show']]);
