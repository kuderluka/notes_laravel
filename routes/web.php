<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

    Route::get('/public', [NoteController::class, 'index'])->name('public.data');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/public', [NoteController::class, 'index'])->name('public.data');
    Route::get('{user}', [UserController::class, 'show'])->name('user.show');

    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');


});

require __DIR__.'/auth.php';
