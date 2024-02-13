<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return response()->json([
            'heading' => 'users',
            'public' => false,
            'entries' => User::all()
        ]);

//        return view('list', [
//            'heading' => 'users',
//            'public' => false,
//            'entries' => User::sortable()->paginate(8)
//        ]);
    }
}
