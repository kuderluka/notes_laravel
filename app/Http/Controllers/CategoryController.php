<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('list', [
            'heading' => 'categories',
            'entries' => Category::all()
        ]);
    }

    public function create()
    {
        return view('edit', [
            'heading' => 'categories'
        ]);
    }

    public function edit(Category $category): string
    {
        return view('edit', [
            'heading' => 'categories',
            'entry' => $category
        ]);
    }

    public function destroy(Category $category): string
    {
        $category->delete();
        return redirect('/categories')->with('message', 'Category deleted successfully');
    }
}
