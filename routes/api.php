<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/public', [NoteController::class, 'index']);

Route::get('/public/users', [UserController::class, 'index']);
Route::get('/public/users/{user}', [EventController::class, 'userEvents']);

Route::get('/statistics', [StatisticsController::class, 'getStatisticsData']);

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('login/socials', [AuthenticatedSessionController::class, 'authenticateSocials']);

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

    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    Route::get('/users/{user}', [EventController::class, 'getSingleUsersData']);

    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    Route::put('/category/store', [CategoryController::class, 'update']);
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy']);

    Route::get('/note/create', [NoteController::class, 'create']);
    Route::post('/note/store', [NoteController::class, 'store']);
    Route::put('/note/store/{note}', [NoteController::class, 'update']);
    Route::get('/note/edit/{note}', [NoteController::class, 'edit']);
    Route::delete('/note/destroy/{note}', [NoteController::class, 'destroyById']);

    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('/addAttendee', [EventController::class, 'addAttendee']);
    Route::post('/removeAttendee', [EventController::class, 'removeAttendee']);

    Route::get('/notes/byUser', [NoteController::class, 'getNotesByUsername']);
    Route::get('/notes/{noteId}', [NoteController::class, 'getNoteById']);
    Route::post('/notes', [NoteController::class, 'store']);
    Route::patch('/notes/{noteId}', [NoteController::class, 'update']);
    Route::delete('/notes/{noteId}', [NoteController::class, 'destroyById']);

    Route::get('/categories', [CategoryController::class, 'list']);
});
