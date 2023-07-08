<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Support\Str;

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

    public function edit(User $user): string
    {
        return view('edit', [
            'heading' => 'users',
            'entry' => $user
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => 'required',
            'email' => ['required', 'email' , Rule::unique('users', 'email')]
        ]);

        $validated += ['id' => (string) Str::orderedUuid()];

        User::create($validated);
        return redirect('/users')->with('message', 'User created successfully');
    }

    public function destroy(User $user): string
    {
        $user->delete();
        return redirect('/users')->with('message', 'User deleted successfully');
    }
}
