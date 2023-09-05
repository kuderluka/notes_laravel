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

Route::get('/', function () { return view('index'); })->name('index');

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('create', [UserController::class, 'create'])->name('create');
    Route::put('store', [UserController::class, 'update'])->name('store');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('{user}', [UserController::class, 'show'])->name('show');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::put('store', [CategoryController::class, 'update'])->name('store');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'notes', 'as' => 'notes.'], function () {
    Route::get('/', [NoteController::class, 'index'])->name('index');
    Route::get('create', [NoteController::class, 'create'])->name('create');
    Route::put('store', [NoteController::class, 'update'])->name('store');
    Route::post('store', [NoteController::class, 'store'])->name('store');
    Route::get('{note}', [NoteController::class, 'edit'])->name('edit');
    Route::delete('{note}', [NoteController::class, 'destroy'])->name('destroy');
});
