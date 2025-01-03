<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\DoctorHoliday;

class doctorHolidayService
{

use jsonTrait;

public static function index(){
$holidays=DoctorHoliday::all();
return jsonTrait::jsonResponse(200,'all holidays',$holidays);


}

public static function doctorHolidays($doc_id){
$doctorHolidays=DoctorHoliday::where('doctor_id',$doc_id)->get();
return jsonTrait::jsonResponse(200,'all holidays of doctor',$doctorHolidays);

}
public static function myHolidays(){
$id=auth()->user()->id;
$myHolidays=DoctorHoliday::where('doctor_id',$id)->get();

return jsonTrait::jsonResponse(200,'my holidays ',$myHolidays);

}
public static function storeHoliday(Request $request){
    $request->validate([
        'bio' =>  'required', 'string', 'max:255',

    ]);
    $id=auth()->user()->id;
       $holiday=DoctorHoliday::create([
    'doctor_id' => $id,
    'day' => $request->day,
]);
return jsonTrait::jsonResponse(200,'store holiday successfully ',$holiday);

}
public static function updateHoliday(Request $request,$id){
    $request->validate([
        'day' =>  'required', 'string', 'max:255',

    ]);
    $holiday=DoctorHoliday::findOrFail($id);
    $doctor_id=auth()->user()->id;
    $holiday->update([
          'doctor_id' => $doctor_id,
          'day' => $request->day,
           ]);
return jsonTrait::jsonResponse(200,'update holiday successfully ',$holiday);

}
public static function deleteHoliday($id){
    $holiday=DoctorHoliday::findOrFail($id);
     $holiday->delete();
return jsonTrait::jsonResponse(200,'delete holiday successfully ',);

}

}
