<?php

use App\Http\Controllers\TodoController;
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

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/', [TodoController::class, 'store'])->name('todos.store');
Route::post('/{todo}', [TodoController::class, 'done'])->name('todos.done');
Route::delete('/{todo}', [TodoController::class, 'delete'])->name('todos.delete');
Route::put('/{todo}', [TodoController::class, 'edit'])->name('todos.edit');
