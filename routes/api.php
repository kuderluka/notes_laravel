<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/public', [NoteController::class, 'index'])->name('public.data');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user}', [EventController::class, 'userEvents'])->name('user.profile');

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);


Route::post('/tokens/authenticate', function (LoginRequest $request) {
    $request->authenticate();

    $user = User::where('email', $request->validated('email'))->first();
    $token = $user->createToken($user->username)->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);


    Route::get('/notes/byUser', [NoteController::class, 'getNotesByUsername']);
    Route::get('/notes/{noteId}', [NoteController::class, 'getNoteById']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::patch('/notes/{noteId}', [NoteController::class, 'update']);
    Route::delete('/notes/{noteId}', [NoteController::class, 'destroyById']);

    Route::get('/categories', [CategoryController::class, 'list']);
});
