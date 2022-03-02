<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('check.token')->group(function () {

    Route::get('tipo-documentos', 'TipoDocumentoController@index')->name('tipo-documentos.get');
    Route::get('tipo-documentos/{id}', 'TipoDocumentoController@show')->name('tipo-documentos.show');
    Route::post('tipo-documentos', 'TipoDocumentoController@create')->name('tipo-documentos.create');
    Route::put('tipo-documentos/{id}', 'TipoDocumentoController@update')->name('tipo-documentos.update');
    Route::delete('tipo-documentos/{id}', 'TipoDocumentoController@delete')->name('tipo-documentos.delete');



    Route::get('usuarios', 'UsuarioController@index')->name('usuarios.get');
    Route::get('usuarios/{id}', 'UsuarioController@show')->name('usuarios.show');
    Route::post('usuarios', 'UsuarioController@create')->name('usuarios.create');
    Route::put('usuarios/{id}', 'UsuarioController@update')->name('usuarios.update');
    Route::delete('usuarios/{id}', 'UsuarioController@delete')->name('usuarios.delete');

});
