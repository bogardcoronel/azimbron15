<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home',  
    [
        'as' => 'home', 
        'uses' =>'HomeController@index'
    ]);

Route::post('register', 'Auth\AuthController@register');
Route::get('register', 'Auth\AuthController@registration');
Route::get('pagos/index', 'PagosController@index');
Route::get('pagos/create', 'PagosController@create');
Route::post('pagos/store', 'PagosController@store');
Route::get('pagos/cantidad', 'PagosController@cantidadPago');
Route::get('usuarios/index', 'UsuarioController@index');
Route::get('usuarios/create', 'UsuarioController@create');
Route::post('usuarios/store', 'UsuarioController@store');
Route::get('pagosPendientes/index', 'PagoPendienteController@index');
Route::get('pagosRealizados/index', 'PagoRealizadoController@index');
Route::get('pagosRealizados/create', 'PagoRealizadoController@create');
Route::post('pagosRealizados/store', 'PagoRealizadoController@store');
Route::get('pagosRealizados/{id}/image','PagoRealizadoController@getImageEvidencia');
