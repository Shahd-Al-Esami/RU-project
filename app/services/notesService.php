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
        $note=Note::findOrfail($id);
        $id=auth()->user()->id;
         $note->update([
             'doctor_id' => $id,
             'patient_id' => $patient_id,
              'description' => $request->desription,
             ]);
    return jsonTrait::jsonResponse(200,'update note',$note);

    }
    public static function storeNote(Request $request,$patient_id)
    {
        $id=auth()->user()->id;
    $note=Note::create([
    'doctor_id' => $id,
    'patient_id' => $patient_id,
    'description' => $request->desription,
         ]);
    return jsonTrait::jsonResponse(200,'note:',$note);

    }
    public static function deleteNote(Note $note)
    {
       $note->delete();
    return jsonTrait::jsonResponse(200,'delete note',null);

    }

    public static function allNotesOfPatient($id){
      $notes=User::where('id',$id)->with('notes')->get();
     return jsonTrait::jsonResponse(200,'all notes of this patient',$notes);

    }
}
