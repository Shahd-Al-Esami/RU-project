<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Services\notesService;
use App\Http\Controllers\Controller;

class NotesController extends Controller
{
    public  function updateNote(Request $request,$id,$patient_id)
    {
        $result = notesService::updateNote( $request,$id,$patient_id,);

        return response()->json(['message' => $result]);
    }
    public  function storeNote(Request $request,$patient_id)
    {
        $result = notesService::storeNote( $request,$patient_id,);

        return response()->json(['message' => $result]);
    }
    public  function deleteNote($id)
    {
        $result = notesService::deleteNote( $id);

        return response()->json(['message' => $result]);
    }
    public  function allNotesOfPatient($id)
    {
        $result = notesService::allNotesOfPatient( $id);

        return response()->json(['message' => $result]);
    }

    public  function myNotes()
    {
        $result = notesService::myNotes();

        return response()->json(['message' => $result]);
    }
}
