<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\suggestService;
use App\Http\Controllers\Controller;

class SuggestController extends Controller
{
    public  function getSuggests($plan_id)
    {
        $result = suggestService::getSuggests($plan_id);

        return response()->json(['message' => $result]);
    }

     public  function storeSuggest(Request $request,$plan_id)
    {
        $result = suggestService::storeSuggest($request,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function updateSuggest(Request $request,$id,$plan_id)
    {
        $result = suggestService::updateSuggest($request,$id,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function deleteSuggest($id)
    {
        $result = suggestService::deleteSuggest($id);

        return response()->json(['message' => $result]);
    }
    
}
