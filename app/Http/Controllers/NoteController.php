<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the note.
     */
    public function index()
    {
        $notes = $this->getUserNote('status', '!=', 'archive');
        return view('pages.note.index', ['notes' => $notes]);
    }
    
    public function archivePage()
    {
        $notes = $this->getUserNote('status', '=', 'archive');
        return view('pages.archive.index', ['notes' => $notes]);
    }
    
    /**
     * Show the form for creating a new note.
     */
    public function create()
    {
        return view('pages.note.create');
    }

    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->only(['title', 'content', 'status']);

        $user = User::find(Auth::id());
        $note = new Note();

        $note->title = $payload['title'];
        $note->content = $payload['content'];
        $note->status = $payload['status'];

        $user->notes()->save($note);

        return redirect()->route('note.show', [$note]);
    }

    /**
     * Display the specified note.
     */
    public function show(Note $note)
    {
        return view('pages.note.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified note.
     */
    public function edit(Note $note)
    {
        return view('pages.note.edit', ['note' => $note]);
    }

    /**
     * Update the specified note in storage.
     */
    public function update(Request $request, Note $note)
    {
        $input = $request->only(['title', 'content', 'status']);

        $note->title = $input['title'];
        $note->content = $input['content'];
        $note->status = $input['status'];

        $note->save();

        return redirect()->route('note.show', $note);
    }

    /**
     * Remove the specified note from storage.
     */
    public function destroy(Note $note)
    {
        //
    }

    /**
     * Change specified note status to favorite
    */
    public function favorite(Note $note)
    {
        if ($note->status === 'favorite') {
            $note->status = 'none';
        } else {
            $note->status = 'favorite';
        }

        $note->save();

        return back();
    }

    /**
     * Change specified note status to archive
    */
    public function archive(Note $note)
    {
        if ($note->status === 'archive') {
            $note->status = 'none';
        } else {
            $note->status = 'archive';
        }

        $note->save();

        return back();
    }

    /**
     * Methods in below are not action method
    */

    /**
     * Get current user's notes
     */
    protected function getUserNote(string $column, string $operator, string $value)
    {
        $user = User::find(Auth::id());

        return $user->notes()
            ->where($column, $operator, $value)
            ->get();
    }
}
