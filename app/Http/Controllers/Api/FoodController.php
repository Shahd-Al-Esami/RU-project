<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\FoodService;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public  function storeFood(Request $request)
    {
        $result = FoodService::storeFood($request);

        return response()->json(['message' => $result]);
    }
    public  function updateFood(Request $request,$id)
    {
        $result = FoodService::updateFood( $request,$id);

        return response()->json(['message' => $result]);
    }
    public  function foodIngredient($id)
    {
        $result = FoodService::foodIngredient($id);

        return response()->json(['message' => $result]);
    }
    public  function deleteFood($id)
    {
        $result = FoodService::deleteFood($id);

        return response()->json(['message' => $result]);
    }
    public  function index()
    {
        $result = FoodService::index();

        return response()->json(['message' => $result]);
    }
}
