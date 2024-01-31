<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns the view that displays all the users
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('list', [
            'heading' => 'users',
            'public' => false,
            'entries' => User::sortable()->paginate(8)
        ]);
    }
}
