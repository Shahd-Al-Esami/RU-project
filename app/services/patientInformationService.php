<?php

namespace App\Services;

use App\Models\User;
use App\Models\PlanOrder;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Models\PatientInformation;

class patientInformationService
{

use jsonTrait;


public static function store(Request $request){
    $patient_id=auth()->user()->id;
        $patientInformation=PatientInformation::create([
        'desirable_foods'           =>$request->desirable_foods,
        'height'                    =>$request->height,
        'patient_id'                =>$patient_id,
        'weight'                    =>$request->weight,
        'answers'                   =>$request->answers,
        'financial_state'           =>$request->financial_state,
        'health_state'              =>$request->health_state,
         ]);

        return jsonTrait::jsonResponse(200,'store patient information  ',$patientInformation);

      }

      public static function update(Request $request,$id){
        $patient_id=auth()->user()->id;
        $patientInformation=PatientInformation::findOrFail($id);
            $patientInformation->update([
            'desirable_foods'           =>$request->desirable_foods,
            'height'                    =>$request->height,
            'patient_id'                =>$patient_id,
            'weight'                    =>$request->weight,
            'answers'                   =>$request->answers,
            'financial_state'           =>$request->financial_state,
            'health_state'              =>$request->health_state,
             ]);

            return jsonTrait::jsonResponse(200,'store patient information  ',$patientInformation);

          }
          public static function myProfile(){
            $id=auth()->user()->id;
            $myProfile=User::where('id',$id)->with('patientInformation')->first();
            return jsonTrait::jsonResponse(200,'my profile',$myProfile);

        }

        public static function updateProfile(Request $request){
            $id=auth()->user()->id;
            $user=User::findOrFail($id);
            $image=null;
            if(request()->hasFile('image'))
            {
                $file=request()->file('image');
                $image=uploadImage($file,'posts');
            }
            $user1=$user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'country' => $request->country,
                'age' => $request->age,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'image' =>$image,
            ]);
           $info= $user->patientInformation;
            $info1=$info->update([
           'desirable_foods'            =>$request->desirable_foods,
            'height'                    =>$request->height,
            'patient_id'                =>$id,
            'weight'                    =>$request->weight,
            'answers'                   =>$request->answers,
            'financial_state'           =>$request->financial_state,
            'health_state'              =>$request->health_state,

            ]);
            return jsonTrait::jsonResponse(200,'edit profile',[$user1,$info1]);


        }

}
