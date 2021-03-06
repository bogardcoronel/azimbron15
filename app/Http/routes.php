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
Route::get('pagosPendientes/pagoPendienteDeptos', 'PagoPendienteController@pagoPendienteDeptos');
Route::get('pagosRealizados/index', 'PagoRealizadoController@index');
Route::get('pagosRealizados/create', 'PagoRealizadoController@create');
Route::get('pagosRealizados/{id}/show', 'PagoRealizadoController@show');
Route::post('pagosRealizados/store', 'PagoRealizadoController@store');
Route::get('pagosRealizados/{id}/approve', 'PagoRealizadoController@approve');
Route::get('evidencia/{id}/image','EvidenciaController@getImageEvidencia');
Route::controllers([
    'password' => 'Auth\PasswordController',
]);

Route::get('sendemail', function () {

    $data = array(
        'name' => "Learning Laravel",
    );

    Mail::send('emails.welcome', $data, function ($message) {

        $message->from('no-reply@azimbron.com', 'Learning Laravel');

        $message->to('bogardcoronel@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been sent successfully";

});
