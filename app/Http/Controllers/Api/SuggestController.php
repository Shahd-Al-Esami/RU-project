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
}
