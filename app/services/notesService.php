<?php

namespace App\Services;


use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class notesService
{

use jsonTrait;
//doctor
public static function updateNote(Request $request,$patient_id,$id)
    {
        $request->validate([
            'description' =>  'required', 'string', 'max:255',
        ]);

        $note=Note::findOrfail($id);
        $id=auth()->user()->id;
         $note->update([
             'doctor_id' => $id,
             'patient_id' => $patient_id,
              'description' => $request->description,
             ]);
    return jsonTrait::jsonResponse(200,'update note',$note);

    }
    public static function storeNote(Request $request,$patient_id)
    {
        $request->validate([
            'description' =>  'required', 'string', 'max:255',
        ]);
        $id=auth()->user()->id;
    $note=Note::create([
    'doctor_id' => $id,
    'patient_id' => $patient_id,
    'description' => $request->description,
         ]);
    return jsonTrait::jsonResponse(200,'note:',$note);

    }
    public static function deleteNote($id)
    {
       $note=Note::findOrFail($id);
       $note->delete();
    return jsonTrait::jsonResponse(200,'delete note',null);

    }

    public static function allNotesOfPatient($id){
        $doc_id=auth()->user()->id;
     $notes=Note::where('patient_id',$id)->where('doctor_id',$doc_id)->get();
     return jsonTrait::jsonResponse(200,'all notes of this patient',$notes);

    }

    //patient
public static function myNotes(){
    $id=auth()->user()->id;
    $notes=Note::where('patient_id',$id)->get();
    return jsonTrait::jsonResponse(200, 'my notes',$notes );

}
}
