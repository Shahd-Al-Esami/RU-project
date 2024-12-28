<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ingredientService;
use App\Http\Controllers\Controller;

class IngredientController extends Controller
{
    public  function storeIngredient(Request $request)
    {
        $result = ingredientService::storeIngredient($request);

        return response()->json(['message' => $result]);
    }
    public  function updateingredient(Request $request,$id)
    {
        $result = ingredientService::updateingredient( $request,$id);

        return response()->json(['message' => $result]);
    }
    public  function deleteIngredient($id)
    {
        $result = ingredientService::deleteIngredient($id);

        return response()->json(['message' => $result]);
    }
   
    public  function index()
    {
        $result = ingredientService::index();

        return response()->json(['message' => $result]);
    }  
}
