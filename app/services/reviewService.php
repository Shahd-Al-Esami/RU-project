<?php
namespace App\Services;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;
use App\Http\Requests\ReviewRequest;

class ReviewService
{

use jsonTrait;
//doctor
public static function addPatientReview(ReviewRequest $request,$patient_id){

    $request->validate([
        'reviewable_id' => 'exists:users,id',
    ]);
  $review=Review::create([
    'comment'         => $request->comment,
    'rate'            => $request->rate,
    'user_id'         => auth()->user()->id,
    'reviewable_id'   => $patient_id,
    'reviewable_type' => 'patient',
  ]);

    return jsonTrait::jsonResponse(200, 'review added successfully ', $review);

}

//patient
public static function addPlanReview(ReviewRequest $request,$plan_id){

    $request->validate([
        'reviewable_id' =>  'exists:plans,id',
    ]);
    $review=Review::create([
      'comment'         => $request->comment,
      'rate'            => $request->rate,
      'user_id'         => auth()->user()->id,
      'reviewable_id'   => $plan_id,
      'reviewable_type' => 'plan',
    ]);

      return jsonTrait::jsonResponse(200, 'review added successfully ', $review);

  }


  public static function getReview(){

    $id=auth()->user()->id;
    $review=Review::where('user_id',$id)->where('reviewable_type','plan')->get();

    return jsonTrait::jsonResponse(200, 'show review of the plan ', $review);

}

  //doctor
public static function getPlanReview($id){

     $review=Review::where('reviewable_type','plan')->where('reviewable_id',$id)->get();
    return jsonTrait::jsonResponse(200, 'review of the plan ', $review);

}
//admin
public static function getPlansReviews(){

      $review=Review::where('reviewable_type','plan')->get();

    return jsonTrait::jsonResponse(200, 'reviews of the plans ', $review);

    }
//admin+doctor
    public static function getPatientReview($id){

        $review=Review::where('reviewable_type','patient')->where('reviewable_id',$id)->get();
       return jsonTrait::jsonResponse(200, 'review of the patient ', $review);

   }

//doctor
public static function myReviewForMyPatients(){

    $id=auth()->user()->id;
    $review=Review::where('user_id',$id)->where('reviewable_type','patient')->get();
   return jsonTrait::jsonResponse(200, 'review of my patients ', $review);

}


}
