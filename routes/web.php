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

Route::get('tipo-documentos', 'TipoDocumentoController@index')->name('tipo-documentos');
Route::post('tipo-documentos', 'TipoDocumentoController@create')->name('tipo-documentos');
Route::put('tipo-documentos/{tipoDocumento}', 'TipoDocumentoController@update')->name('tipo-documentos');
Route::delete('tipo-documentos/{tipoDocumento}', 'TipoDocumentoController@delete')->name('tipo-documentos');
