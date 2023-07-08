<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

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
            'heading' => 'notes'
        ]);
    }

    public function updateForm(Note $note): string
    {
        return view('edit', [
            'heading' => 'notes',
            'entry' => $note
        ]);
    }

    public function destroy(Note $note): string
    {
        $note->delete();
        return redirect('/notes')->with('message', 'Note deleted successfully');
    }
}
