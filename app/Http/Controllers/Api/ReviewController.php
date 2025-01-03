<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ReviewService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public  function addPatientReview(ReviewRequest $request,$patient_id)
    {
        $result = ReviewService::addPatientReview($request,$patient_id);

        return response()->json(['message' => $result]);
    }



    public  function getPlanReview($id)
    {
        $result = ReviewService::getPlanReview($id);

        return response()->json(['message' => $result]);
    }

    public  function getPlansReviews()
    {
        $result = ReviewService::getPlansReviews();

        return response()->json(['message' => $result]);
    }
    public  function getPatientReview($id)
    {
        $result = ReviewService::getPatientReview($id);

        return response()->json(['message' => $result]);
    }
    public  function myReviewForMyPatients()
    {
        $result = ReviewService::myReviewForMyPatients();

        return response()->json(['message' => $result]);
    }
//patient
    public  function getReview()
    {
        $result = ReviewService::getReview();

        return response()->json(['message' => $result]);
    }

    public  function addPlanReview(ReviewRequest $request,$plan_id)
    {
        $result = ReviewService::addPlanReview($request,$plan_id);

        return response()->json(['message' => $result]);
    }

}
