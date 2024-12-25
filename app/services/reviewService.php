<?php
namespace App\Services;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Traits\jsonTrait;

class reviewService
{

use jsonTrait;
//doctor
public static function addReview(Request $request){

  $review=Review::create([
    'comment'         => $request->comment,
    'rate'            => $request->rate,
    'user_id'         => auth()->user()->id,
    'reviewable_id'   => $request->reviewable_id,
    'reviewable_type' => $request->reviewable_type,
  ]);

    return jsonTrait::jsonResponse(200, 'review added successfully ', $review);

}

public static function getPlanReview($id){

     $review=Review::where('reviewable_type','plan')->where('reviewable_id',$id)->get();
    return jsonTrait::jsonResponse(200, 'review of the plan ', $review);

}

public static function getPlansReviews(){

      $review=Review::where('reviewable_type','plan')->get();

    return jsonTrait::jsonResponse(200, 'reviews of the plans ', $review);

    }

 public static function getDoctorReview($id){

    $review=Review::where('reviewable_type','doctor')->where('reviewable_id',$id)->get();

    return jsonTrait::jsonResponse(200, 'reviews of the doctor ', $review);

 }

 public static function getDoctorsReviews(){

     $review=Review::where('reviewable_type','doctor')->get();

    return jsonTrait::jsonResponse(200, 'reviews of the doctors ', $review);

 }


}
