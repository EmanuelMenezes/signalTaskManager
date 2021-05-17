<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\Location;


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




Route::get('/', [App\Http\Controllers\TarefaController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', [App\Http\Controllers\TarefaController::class, 'index'])->name('home')->middleware('auth');
Route::get('teste', function(){
    return view('auth.passwords.test');
});

Auth::routes();


Route::get('tarefas/create', [App\Http\Controllers\TarefaController::class, 'create'])->middleware('auth');
Route::post('/tarefa', [App\Http\Controllers\TarefaController::class, 'store'])->name('store');
Route::get('tarefas/{tarefa}/edit', [App\Http\Controllers\TarefaController::class, 'edit'])->middleware('auth');
Route::get('tarefas/{tarefa}', [App\Http\Controllers\TarefaController::class, 'show'])->middleware('auth');
Route::any('tarefas/{tarefa}', [App\Http\Controllers\TarefaController::class, 'update'])->middleware('auth');
Route::any('tarefas/owner/{tarefa}', [App\Http\Controllers\TarefaController::class, 'oupdate'])->middleware('auth');
Route::any('tarefas/status/{tarefa}', [App\Http\Controllers\TarefaController::class, 'supdate'])->middleware('auth');
Route::delete('tarefas/{tarefa}', [App\Http\Controllers\TarefaController::class, 'destroy'])->middleware('auth');

Route::get('/user',[App\Http\Controllers\HomeController::class, 'profile'] )->middleware('auth')->name('user');
Route::any('user/update/{user}', [App\Http\Controllers\HomeController::class, 'update'])->middleware('auth');
