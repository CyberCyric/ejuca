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

Auth::routes();
Route::get('/cursos_alumno/{id}', 'App\Http\Controllers\CursoController@listarCursos')->middleware('auth')->name('inscribir');
Route::get('/inscripciones/{id}', 'App\Http\Controllers\CursoController@listarInscripciones')->middleware('auth')->name('inscribir');
Route::post('/cursos_alumno/inscribir', 'App\Http\Controllers\CursoController@inscribir')->middleware('auth');

Route::resource('/cursos', 'App\Http\Controllers\CursoController')->middleware('auth');
Route::resource('/alumnos', 'App\Http\Controllers\AlumnoController')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
