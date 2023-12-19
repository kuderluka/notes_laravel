<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
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

Route::get('/public', [NoteController::class, 'index'])->name('public.data');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user', [ProfileController::class, 'show'])->name('user.show');

    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/store', [CategoryController::class, 'update'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
    Route::put('/note/store', [NoteController::class, 'update'])->name('note.store');
    Route::get('/note/edit/{note}', [NoteController::class, 'edit'])->name('note.edit');
    Route::delete('/note/destroy/{note}', [NoteController::class, 'destroy'])->name('note.destroy');

    Route::get('/events', [EventController::class, 'index'])->name('events.list');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('event.show');
    Route::post('/addAttendee', [EventController::class, 'addAttendee'])->name('event.addAttendee');
    Route::post('/removeAttendee', [EventController::class, 'removeAttendee'])->name('event.removeAttendee');
});

require __DIR__.'/auth.php';
