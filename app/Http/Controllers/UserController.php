<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    /**
     * Returns the list of all users
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'heading' => 'users',
            'public' => false,
            'entries' => User::all()
        ]);
    }
}
