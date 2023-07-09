<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            'heading' => 'users',
            'entry' => [],
            'editing' => FALSE
        ]);
    }

    public function edit(User $user)
    {
        return view('edit', [
            'heading' => 'users',
            'entry' => $user,
            'editing' => TRUE
        ]);
    }

    public function update(Request $request)
    {
        File::delete(public_path() . '/storage/' . $request->oldImage);

        if($request->hasFile('image')) {
            $request['image'] = 'submitted';
        }

        $validated = $request->validate([
            'id' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => ['required', 'email'],
            'image' => 'required'
        ]);

        $validated['image'] = $request->file('image')->store('images', 'public');
        User::where('id', $validated['id'])->update($validated);
        return redirect('/users')->with('message', 'User updated successfully');
    }

    public function store(Request $request) {
        if($request->hasFile('image')) {
            $request['image'] = 'submitted';
        }

        $validated = $request->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => 'required',
            'email' => ['required', 'email' , Rule::unique('users', 'email')],
            'image' => 'required'
        ]);

        $validated['image'] = $request->file('image')->store('images', 'public');
        $validated['id'] = (string) Str::orderedUuid();

        User::create($validated);
        return redirect('/users')->with('message', 'User created successfully');
    }

    public function destroy(User $user): string
    {
        File::delete(public_path() . '/storage/' . $user->image);
        $user->delete();
        return redirect('/users')->with('message', 'User deleted successfully');
    }
}
