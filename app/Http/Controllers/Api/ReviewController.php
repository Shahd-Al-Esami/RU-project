<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\reviewService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public  function addPatientReview(ReviewRequest $request,$patient_id)
    {
        $result = reviewService::addPatientReview($request,$patient_id);

        return response()->json(['message' => $result]);
    }



    public  function getPlanReview($id)
    {
        $result = reviewService::getPlanReview($id);

        return response()->json(['message' => $result]);
    }

    public  function getPlansReviews()
    {
        $result = reviewService::getPlansReviews();

        return response()->json(['message' => $result]);
    }
    public  function getPatientReview($id)
    {
        $result = reviewService::getPatientReview($id);

        return response()->json(['message' => $result]);
    }
    public  function myReviewForMyPatients()
    {
        $result = reviewService::myReviewForMyPatients();

        return response()->json(['message' => $result]);
    }
//patient
    public  function getReview()
    {
        $result = reviewService::getReview();

        return response()->json(['message' => $result]);
    }

    public  function addPlanReview(ReviewRequest $request,$plan_id)
    {
        $result = reviewService::addPlanReview($request,$plan_id);

        return response()->json(['message' => $result]);
    }

}
