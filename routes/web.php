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

//Open the default ciews
Route::get('/', function () { return view('index'); });
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/notes', [NoteController::class, 'index']);

//Open the create view
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::get('/notes/create', [NoteController::class, 'create']);

//Directs to the method that creates a new database entry
Route::post('/users', [UserController::class, 'store']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::post('/notes', [NoteController::class, 'store']);

//Opens the edit view
Route::get('/users/{user}', [UserController::class, 'edit']);
Route::get('/categories/{category}', [CategoryController::class, 'edit']);
Route::get('/notes/{note}', [NoteController::class, 'edit']);

//Directs to the method that updates an existing entry
Route::put('/users', [UserController::class, 'update']);
Route::put('/categories', [CategoryController::class, 'update']);
Route::put('/notes', [NoteController::class, 'update']);

//Directs to the method that deletes an entry
Route::delete('/users/{user}', [UserController::class, 'destroy']);
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
