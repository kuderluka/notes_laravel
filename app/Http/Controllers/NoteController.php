<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    public function index() {
        return view('list', [
            'heading' => 'notes',
            'entries' => Note::all()
        ]);
    }

    public function create()
    {
        return view('edit', [
            'heading' => 'notes',
            'entry' => [],
            'editing' => FALSE
        ]);
    }

    public function edit(Note $note)
    {
        return view('edit', [
            'heading' => 'notes',
            'entry' => $note,
            'editing' => TRUE
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'user' => 'required',
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
            'priority' => 'required',
            'deadline' => 'required',
            'tags' => 'required'
        ]);

        Note::where('id', $validated['id'])->update($validated);
        return redirect('/notes')->with('message', 'Note updated successfully');
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'user' => 'required',
            'category' => 'required',
            'title' => ['required', Rule::unique('notes' , 'title')],
            'content' => 'required',
            'priority' => 'required',
            'deadline' => 'required',
            'tags' => 'required'
        ]);

        $validated['id'] = (string) Str::orderedUuid();
        $note = Note::create($validated);

        //Ni slo ne glede na to kaj sem poskusil zato sm kr brute forcu
        //$note->user()->attach($request->user);
        //$note->category()->attach($request->category);

        //$user = User::find($request->user);
        //$category = Category::find($request->category);

        //$user->notes()->save($note);
        //$category->notes()->save($note);

        return redirect('/notes')->with('message', 'Note created successfully');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect('/notes')->with('message', 'Note deleted successfully');
    }
}
