<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\SuggestService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuggestRequest;

class SuggestController extends Controller
{
    public  function getSuggests($plan_id)
    {
        $result = SuggestService::getSuggests($plan_id);

        return response()->json(['message' => $result]);
    }

     public  function storeSuggest(SuggestRequest $request,$plan_id)
    {
        $result = SuggestService::storeSuggest($request,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function updateSuggest(SuggestRequest $request,$id,$plan_id)
    {
        $result = SuggestService::updateSuggest($request,$id,$plan_id);

        return response()->json(['message' => $result]);
    }

    public  function deleteSuggest($id)
    {
        $result = SuggestService::deleteSuggest($id);

        return response()->json(['message' => $result]);
    }

}
