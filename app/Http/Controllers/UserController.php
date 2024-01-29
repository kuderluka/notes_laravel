<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('list', [
            'heading' => 'users',
            'public' => false,
            'entries' => User::sortable()->paginate(8)
        ]);
    }

    /**
     * Returns the view of a certain users profile
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(User $user)
    {
        return view('user-show', [
            'user' => $user,
            'notes' => $user->notes()->where('public', 1)->paginate(3)
        ]);
    }
}
