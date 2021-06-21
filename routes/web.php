<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistanciaController;

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

Route::resource('/datafrete', DistanciaController::class);
Route::get('/api/validacao-cep/{cep}', 'App\Http\Controllers\CepController@cepValido');
Route::get('/api/coordenadas-cep/{cep1}/{cep2}', 'App\Http\Controllers\CepController@coordenadas');