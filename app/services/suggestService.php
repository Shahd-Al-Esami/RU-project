<?php

namespace App\Services;
use App\Models\User;
use App\Models\Suggest;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\SuggestRequest;

class SuggestService
{

use jsonTrait;
//doctor
public static function getSuggests($plan_id){
  $suggests=Suggest::where('plan_id',$plan_id)->get();
  return jsonTrait::jsonResponse(200,'all suggests of this plan',$suggests);
}

public static function patientSuggests()
{
    $id=auth()->user()->id;
    $suggests=User::where('id',$id)->with('suggests')->get();
    return jsonTrait::jsonResponse(200,'all  my suggests ',$suggests);

}
//patient
public static function storeSuggest(SuggestRequest $request,$plan_id){
       $suggest = Suggest::create([
        'suggest'      => $request->suggest,
        'patient_id'   => auth()->user()->id,
        'plan_id'      => $plan_id,
    ]);
    return jsonTrait::jsonResponse(201, 'Stored suggest successfully', $suggest);
}

public static function updateSuggest(SuggestRequest $request,$id,$plan_id){
    $suggest=Suggest::findOrfail($id);
    $suggest->update([
     'suggest'      => $request->suggest,
     'patient_id'   => auth()->user()->id,
     'plan_id'      => $plan_id,
 ]);
 return jsonTrait::jsonResponse(201, 'update suggest successfully', $suggest);
}
public static function deleteSuggest($id){

    $suggest=Suggest::findOrfail($id);
    $suggest->delete();
 return jsonTrait::jsonResponse(201, 'delete suggest successfully', null);
}

}
