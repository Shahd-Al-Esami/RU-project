<?php

namespace App\Services;
use App\Models\User;
use App\Models\Suggest;
use App\Http\Traits\jsonTrait;

class suggestService
{

use jsonTrait;
//doctor
public static function getSuggests($plan_id){
  $suggests=Suggest::where('plan_id',$plan_id)->get();
  return jsonTrait::jsonResponse(200,'all suggests of this plan',$suggests);
}

public static function patientSuggests($id)
{

    $suggests=User::where('id',$id)->with('suggests')->get();
    return jsonTrait::jsonResponse(200,'all suggests of this patient',$suggests);

}

}
