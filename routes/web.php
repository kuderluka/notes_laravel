<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('index'); });
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/notes', [NoteController::class, 'index']);

//Creates a new entry
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::get('/notes/create', [NoteController::class, 'create']);

Route::get('/users/{user}', [UserController::class, 'updateForm']);
Route::get('/categories/{category}', [CategoryController::class, 'updateForm']);
Route::get('/notes/{note}', [NoteController::class, 'updateForm']);

Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
