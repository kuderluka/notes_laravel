<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $notes = Note::where('public', 1)
            ->with('category')
            ->with('user')
            ->filterSearch(request(['search']))
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'notes' => $notes,
            ],
            'message' => 'Notes successfully retrieved.'
        ]);
    }

    /**
     * Gets all notes of user by their username
     *
     * @return JsonResponse
     */
    public function getNotesByUsername(): JsonResponse
    {
        return response()->json(
        [
            'success' => true,
            'data' => [
                'notes' => User::with('notes')->findOrFail(Auth::user()->id)->notes,
            ],
            'message' => 'Note successfully retrieved.'
        ]);
    }

    /**
     * Gets single note by id
     *
     * @param $id
     * @return JsonResponse
     */
    public function getNoteById($id): JsonResponse
    {
        $note = Note::findOrFail($id);

        if ($id->user_id !== Auth::user()->id) {
            return response()->json([
                'success' => false,
                'data' => [
                    'note' => $id,
                ],
                'message' => 'Cannot access this note.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'note' => $note,
            ],
            'message' => 'Note successfully retrieved.'
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
    public function update(Request $request): string
    {
        $noteId = $request->id;
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
        $validated['user_id'] = Auth::user()->id;
        Note::where('id', $validated['id'])->update($validated);
        return response()->json([
            'message' => 'Success!',
            'data' => [

            ]
        ]);
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
            'category_id' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title'), 'min:5', 'max:30'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => ['required', 'date', 'after:now'],
            'tags' => ['required', 'max:200'],
            'public' => 'required'
        ]);

        $user = Auth::user();
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

        return response()->json([
            'message' => 'Success!',
            'data' => [
                'note' => $note
            ]
        ]);
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

    /**
     * Destroys note by id
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroyById(string $id): JsonResponse
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json('Note deleted.');
    }
}
