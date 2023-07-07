<?php

use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', function () {
    return view('list', [
        'heading' => 'Categories',
        'entries' => Category::all()
    ]);
});

Route::get('/users', function () {
    return view('list', [
        'heading' => 'Users',
        'entries' => User::all()
    ]);
});
