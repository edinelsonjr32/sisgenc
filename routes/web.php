<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'administrador', 'namespace' => 'Admin', 'as' =>'admin.', 'middleware' => ['auth', 'CheckAdmin']], function () {
    Route::resource('tipo_usuario', 'TipoUsuarioController');
    Route::resource('estado', 'EstadoController');
    Route::resource('cidade', 'CidadeController');
    Route::resource('unidade', 'UnidadeController');
    Route::resource('usuario', 'UsuarioController');
});
