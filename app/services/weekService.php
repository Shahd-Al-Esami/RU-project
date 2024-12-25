<?php

namespace App\Services;
use App\Models\Week;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class weekService
{

use jsonTrait;
//admin
public static function storeWeek(Request $request){
    $week=Week::create([
        'number' =>$request->number,

    ]);
    $week->meals()->attach($request->meal_ids);

  return jsonTrait::jsonResponse(200,'add Week successfully ',$week);

}

public static function updateWeek(Request $request,Week $week){
    $week->update([
        'number' =>$request->number,

    ]);
    $week->meals()->sync($request->meal_ids);

  return jsonTrait::jsonResponse(200,'update Week successfully ',$week);

}

public static function deleteWeek(Week $week){
    $week->delete();
  return jsonTrait::jsonResponse(200,'delete Week successfully ',null);

}


}
