<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    /**
     * Gets all the statistics data
     *
     * @return JsonResponse
     */
    public function getStatisticsData()
    {
        $users = User::all();

        $data['users'] = $users->map(function ($user) {
            return [
                'user' => $user,
                'notes' => $user->notes()->with('user')->with('category')->get()
            ];
        });

        $data['categories'] = Category::all();
        $data['notes'] = Note::all();

        return response()->json([
            'success' => true,
            'message' => 'Data successfully fetched',
            'data' => $data
        ]);
    }
}
