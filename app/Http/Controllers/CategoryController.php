<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Returns the default view
     *
     * @return string
     */
    public function index():string
    {
        return view('list', [
            'heading' => 'categories',
            'entries' => Category::all()
        ]);
    }

    /**
     * Returns the create view
     *
     * @return string
     */
    public function create():string
    {
        return view('edit', [
            'heading' => 'categories',
            'entry' => [],
            'editing' => FALSE
        ]);
    }

    /**
     * Returns the edit view
     *
     * @param Category $category
     * @return string
     */
    public function edit(Category $category): string
    {
        return view('edit', [
            'heading' => 'categories',
            'entry' => $category,
            'editing' => TRUE
        ]);
    }

    /**
     * Updates the entry in the database and redirects
     *
     * @param Request $request
     * @return string
     */
    public function update(Request $request): string
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

    /**
     * Stores a new entry to the database and redirects
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
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

    /**
     * Deletes the given category
     *
     * @param Category $category
     * @return string
     */
    public function destroy(Category $category): string
    {
        $category->delete();
        return redirect('/categories')->with('message', 'Category deleted successfully');
    }
}
