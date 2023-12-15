<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        return view('list', [
            'heading' => 'notes',
            'public' => 0,
            'entries' => Note::sortable()->filter(request(['search']))->where('public', 1)->paginate(8)
        ]);
    }

    public function getNotesByUsername()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not logged in.'], 401);
        }

        return response()->json([
            'notes' => User::with('notes')->find($user->id)['notes'],
        ]);
    }

    public function getNoteById($note)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not logged in.'], 401);
        }

        $note = Note::find($note);

        if (!$note) {
            return response()->json(['message' => 'Note does not exist.'], 404);
        }

        if ($note->user_id !== $user->id) {
            return response()->json(['message' => 'Cannot access this note.'], 403);
        }

        return response()->json($note);
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
    public function update($noteId, Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not logged in.'], 401);
        }

        $validated = $request->validate([
            'category_id' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title')->ignore($noteId), 'min:5', 'max:30'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => ['required', 'date', 'after:now'],
            'tags' => ['required', 'max:200'],
            'public' => 'required'
        ]);

        $validated['id'] = $noteId;
        $validated['user_id'] = $user->id;
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
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not logged in.'], 401);
        }

        $validated = $request->validate([
            'category_id' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title'), 'min:5', 'max:30'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => ['required', 'date', 'after:now'],
            'tags' => ['required', 'max:200'],
            'public' => 'required'
        ]);

        $validated['id'] = (string) Str::orderedUuid();
        $validated['user_id'] = $user->id;
        $note = Note::create($validated);
        $category = Category::find($request->category_id);

        foreach($category->users as $old_user) {
            if($user->id == $old_user->id) {
                $category->users()->detach($old_user);
            }
        }

        $category->users()->attach($user);
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

    public function destroyById($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json('Note deleted.');
    }
}
