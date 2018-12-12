<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\Note as NoteResource;
use App\Note;

class NotesController extends Controller
{
    public function index()
    {
        return NoteResource::collection(Note::paginate());
    }
    
    public function store(NoteRequest $request)
    {
        $note = new Note();
        $note->fill($request->only($note->getFillable()));
        
        if ($note->save()) {
            return new NoteResource($note);
        }
    }
    
    public function destroy($id)
    {
        return response()->json();
    }
}