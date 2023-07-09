<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'heading' => 'categories',
            'entry' => [],
            'editing' => FALSE
        ]);
    }

    public function edit(Category $category)
    {
        return view('edit', [
            'heading' => 'categories',
            'entry' => $category,
            'editing' => TRUE
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'users' => 'required',
            'title' => ['required', Rule::unique('categories', 'title')],
            'color' => 'required'
        ]);

        unset($validated['users']);

        //To ne dela ce uporabim: ??????
        //$category = Category::where('id', $validated['id'])->update($validated);
        Category::where('id', $validated['id'])->update($validated);
        $category = Category::find($request->id);

        $category->users()->sync($request->users);
        return redirect('/categories')->with('message', 'Category updated successfully');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'users' => 'required',
            'title' => ['required', Rule::unique('categories', 'title')],
            'color' => 'required'
        ]);
        $validated['id'] = (string) Str::orderedUuid();


        $category = Category::create($validated);
        $category->users()->attach($request->users);
        return redirect('/categories')->with('message', 'Category created successfully');
    }

    public function destroy(Category $category): string
    {
        $category->delete();
        return redirect('/categories')->with('message', 'Category deleted successfully');
    }
}
