<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Services\NotesService;
use App\Http\Controllers\Controller;

class NotesController extends Controller
{
    public  function updateNote(Request $request,$id,$patient_id)
    {
        $result = NotesService::updateNote( $request,$id,$patient_id,);

        return response()->json(['message' => $result]);
    }
    public  function storeNote(Request $request,$patient_id)
    {
        $result = NotesService::storeNote( $request,$patient_id,);

        return response()->json(['message' => $result]);
    }
    public  function deleteNote($id)
    {
        $result = NotesService::deleteNote( $id);

        return response()->json(['message' => $result]);
    }
    public  function allNotesOfPatient($id)
    {
        $result = NotesService::allNotesOfPatient( $id);

        return response()->json(['message' => $result]);
    }

    public  function myNotes()
    {
        $result = NotesService::myNotes();

        return response()->json(['message' => $result]);
    }
}
