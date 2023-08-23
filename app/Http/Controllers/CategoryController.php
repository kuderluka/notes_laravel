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
    public function index()
    {
        return view('list', [
            'heading' => 'categories',
            'entries' => Category::latest()->filter(request(['search']))->get()
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
            'heading' => 'categories',
            'entry' => NULL,
        ]);
    }

    /**
     * Returns the edit view
     *
     * @param Category $category
     * @return string
     */
    public function edit(Category $category)
    {
        return view('edit', [
            'heading' => 'categories',
            'entry' => $category,
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
        $validated = $request->validate([
            'id' => 'required',
            'users' => 'required',
            'title' => ['required', Rule::unique('categories', 'title')->ignore($request->id), 'min:3', 'max:30'],
            'color' => 'required'
        ]);

        //'users' are removed from $validated as it is not needed and was only used to simplify validating a field in the checkbox is checked
        unset($validated['users']);

        $category = Category::find($request->id);
        $category->update($validated);

        $category->users()->sync($request->users);
        return redirect(route('categories.index'))->with('message', 'Category updated successfully');
    }

    /**
     * Stores a new entry to the database and redirects
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'users' => 'required',
            'title' => ['required', Rule::unique('categories', 'title'), 'min:3', 'max:30'],
            'color' => 'required'
        ]);
        $validated['id'] = (string) Str::orderedUuid();


        $category = Category::create($validated);
        $category->users()->attach($request->users);
        return redirect(route('categories.index'))->with('message', 'Category created successfully');
    }

    /**
     * Deletes the given category
     *
     * @param Category $category
     * @return string
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('categories.index'))->with('message', 'Category deleted successfully');
    }
}
