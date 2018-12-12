<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\Note as NoteResource;
use App\Note;

class NotesController extends Controller
{
    public function index()
    {
        return NoteResource::collection(Note::orderBy('order')->paginate());
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
        return response()->json(['data' => Note::destroy($id)]);
    }
    
    public function order()
    {
        $order = request()->get('order');
        
        if (is_array($order)) {
            $count = count($order);
            
            for ($i=0; $i<$count; $i++) {
                $id = $order[$i];
                $note = Note::find($id);
                
                if ($note !== null) {
                    $note->order = $i;
                    $note->save();
                }
            }
        }
        
        return response()->json(['data' => 'ok']);
    }
}