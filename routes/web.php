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




Route::controller('TipoDocumentoController')->group(function () {

    Route::get('tipo-documentos', 'index')->name('tipo-documentos');
    Route::get('tipo-documentos/{tipoDocumento}', 'show')->name('tipo-documentos');
    Route::post('tipo-documentos', 'create')->name('tipo-documentos');
    Route::put('tipo-documentos/{tipoDocumento}', 'update')->name('tipo-documentos');
    Route::delete('tipo-documentos/{tipoDocumento}', 'delete')->name('tipo-documentos');
});
