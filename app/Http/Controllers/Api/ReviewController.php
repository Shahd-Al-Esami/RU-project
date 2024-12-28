<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\reviewService;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public  function addPatientReview(Request $request,$patient_id)
    {
        $result = reviewService::addPatientReview($request,$patient_id);

        return response()->json(['message' => $result]);
    }

    public  function addPlanReview(Request $request,$plan_id)
    {
        $result = reviewService::addPlanReview($request,$plan_id);

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
    public  function myReviewForMyPatients($id)
    {
        $result = reviewService::myReviewForMyPatients($id);

        return response()->json(['message' => $result]);
    }
}
