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
}
