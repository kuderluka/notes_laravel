<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    /**
     * Returns the default view
     *
     * @return string
     */
    public function index(): string
    {
        return view('list', [
            'heading' => 'notes',
            'entries' => Note::all()
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
            'entry' => [],
            'editing' => FALSE
        ]);
    }

    /**
     * Returns the edit view
     *
     * @param Note $note
     * @return string
     */
    public function edit(Note $note): string
    {
        return view('edit', [
            'heading' => 'notes',
            'entry' => $note,
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
            'user' => 'required',
            'category' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title')->ignore($request->id), 'min:5', 'max:30'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => 'required',
            'tags' => ['required', 'max:200']
        ]);

        Note::where('id', $validated['id'])->update($validated);
        return redirect('/notes')->with('message', 'Note updated successfully');
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
            'user' => 'required',
            'category' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title'), 'min:3', 'max:50'],
            'content' => ['required', 'max:500'],
            'priority' => ['required', 'integer', 'min:1' , 'max:5'],
            'deadline' => 'required',
            'tags' => ['required', 'max:200']
        ]);

        $validated['id'] = (string) Str::orderedUuid();
        $note = Note::create($validated);

        return redirect('/notes')->with('message', 'Note created successfully');

        //Ni slo ne glede na to kaj sem poskusil zato sm kr brute forcu
        //$note->user()->attach($request->user);
        //$note->category()->attach($request->category);

        //$user = User::find($request->user);
        //$category = Category::find($request->category);

        //$user->notes()->save($note);
        //$category->notes()->save($note);
    }

    /**
     * Deletes the given note
     *
     * @param Note $note
     * @return string
     */
    public function destroy(Note $note): string
    {
        $note->delete();
        return redirect('/notes')->with('message', 'Note deleted successfully');
    }
}
