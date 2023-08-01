<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Returns the default view
     *
     * @return string
     */
    public function index()
    {
        return view('list', [
            'heading' => 'users',
            'entries' => User::sortable()->get()
        ]);
    }

    /**
     * Returns the create view
     *
     * @return string
     */
    public function create()
    {
        return view('edit', [
            'heading' => 'users',
            'entry' => NULL,
        ]);
    }

    /**
     * Returns the edit view
     *
     * @param User $user
     * @return string
     */
    public function edit(User $user)
    {
        return view('edit', [
            'heading' => 'users',
            'entry' => $user,
        ]);
    }

    /**
     * Updates the entry in the database and redirects
     *
     * @param Request $request
     * @return string
     */
    public function update(Request $request)
    {
        File::delete(public_path() . '/storage/' . $request->oldImage);

        if($request->hasFile('image')) {
            $request['image'] = 'submitted';
        }

        //TODO: Add custom validation rules
        $validated = $request->validate([
            'id' => 'required',
            'username' => ['required', 'min:5', 'max:20'],
            'password' => ['required', 'min:5'],
            'email' => ['required', 'email'],
            'image' => ['required', 'image']
        ]);

        $validated['image'] = $request->file('image')->store('images', 'public');
        User::where('id', $validated['id'])->update($validated);
        return redirect(route('users.index'))->with('message', 'User updated successfully');
    }

    /**
     * Stores a new entry to the database and redirects
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            $request['image'] = 'submitted';
        }

        $validated = $request->validate([
            'username' => ['required', Rule::unique('users', 'username'), 'min:5', 'max:20'],
            'password' => ['required', 'min:5'],
            'email' => ['required', 'email' , Rule::unique('users', 'email')],
            'image' => ['required', 'image']
        ]);

        $validated['image'] = $request->file('image')->store('images', 'public');
        $validated['id'] = (string) Str::orderedUuid();

        User::create($validated);
        return redirect(route('users.index'))->with('message', 'User created successfully');
    }

    /**
     * Deletes the given user and it's associated image
     *
     * @param User $user
     * @return string
     */
    public function destroy(User $user)
    {
        File::delete(public_path() . '/storage/' . $user->image);
        $user->delete();
        return redirect(route('users.index'))->with('message', 'User deleted successfully');
    }
}
