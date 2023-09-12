<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    /**
     * Returns the default view
     *
     * @return string
     */
    public function index()
    {
        return view('list', [
            'heading' => 'notes',
            'entries' => Note::sortable()->filter(request(['search']))->where('public', 1)->paginate(2)
        ]);
    }

    /**
     * Returns the create view
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('edit', [
            'heading' => 'notes',
            'entry' => NULL,
        ]);
    }

    /**
     * Returns the edit view
     *
     * @param Note $note
     * @return string
     */
    public function edit(Note $note)
    {
        return view('edit', [
            'heading' => 'notes',
            'entry' => $note,
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
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title')->ignore($request->id), 'min:5', 'max:30'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => 'required',
            'tags' => ['required', 'max:200'],
            'public' => 'required'
        ]);

        Note::where('id', $validated['id'])->update($validated);
        return redirect(route('user.show'))->with('message', 'Note updated successfully');
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
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title'), 'min:3', 'max:50'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => 'required',
            'tags' => ['required', 'max:200'],
            'public' => 'required'
        ]);

        $validated['id'] = (string) Str::orderedUuid();
        $note = Note::create($validated);
        $user = User::find($request->user_id);
        $category = Category::find($request->category_id);

        $note->user()->associate($user);
        $note->category()->associate($category);
        $note->save();

        return redirect(route('user.show'))->with('message', 'Note created successfully');
    }

    /**
     * Deletes the given note
     *
     * @param Note $note
     * @return string
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect(route('user.show'))->with('message', 'Note deleted successfully');
    }
}
