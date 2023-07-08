<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class UserController extends Controller
{
    public function index()
    {
        return view('list', [
            'heading' => 'users',
            'entries' => User::all()
        ]);
    }

    public function create()
    {
        return view('edit', [
            'heading' => 'users'
        ]);
    }

    public function updateForm(User $user): string
    {
        return view('edit', [
            'heading' => 'users',
            'entry' => $user
        ]);
    }

    public function destroy(User $user): string
    {
        $user->delete();
        return redirect('/users')->with('message', 'User deleted successfully');
    }
}
