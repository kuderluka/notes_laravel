<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function list()
    {
        return response()->json([
           'categories' => Category::all(),
        ]);
    }

    /**
     * Returns the default view
     *
     *
     * @return string
     */
    public function index()
    {
        return view('list', [
            'heading' => 'categories',
            'entries' => Category::sortable()->filter(request(['search']))->paginate(2)
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
            'title' => ['required', 'min:3', 'max:30'],
            'color' => 'required'
        ]);

        //'users' are removed from $validated as it is not needed and was only used to simplify validating a field in the checkbox is checked
        unset($validated['users']);

        $category = Category::find($request->id);
        $category->update($validated);

        $category->users()->sync($request->users);
        return redirect(route('user.show'))->with('message', 'Category updated successfully');
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
            'title' => ['required', 'min:3', 'max:30'],
            'color' => 'required'
        ]);
        $validated['id'] = (string) Str::orderedUuid();

        $category = Category::create($validated);
        $category->users()->attach($request->users);
        return response()->json([
            'message' => 'Category created!',
            'data' => []
        ]);
    }

    /**
     * Deletes the given category
     *
     * @param Category $category
     * @return string
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();

        foreach($user->notes as $note) {
            if($note->category_id == $category->id) {
                $note->delete();
            }
        }

        $category->users()->detach($user);
        if($category->users->isEmpty()) {
            $category->delete();
            return redirect(route('user.show'))->with('message', 'Category deleted successfully!');
        }
        return redirect(route('user.show'))->with('message', 'You have been removed from the category successfully!');
    }
}
