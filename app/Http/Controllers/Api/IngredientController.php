<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\IngredientService;
use App\Http\Controllers\Controller;

class IngredientController extends Controller
{
    public  function storeIngredient(Request $request)
    {
        $result = IngredientService::storeIngredient($request);

        return response()->json(['message' => $result]);
    }
    public  function updateingredient(Request $request,$id)
    {
        $result = IngredientService::updateingredient( $request,$id);

        return response()->json(['message' => $result]);
    }
    public  function deleteIngredient($id)
    {
        $result = IngredientService::deleteIngredient($id);

        return response()->json(['message' => $result]);
    }

    public  function index()
    {
        $result = IngredientService::index();

        return response()->json(['message' => $result]);
    }
}
