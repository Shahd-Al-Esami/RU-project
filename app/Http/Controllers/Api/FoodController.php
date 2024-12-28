<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\foodService;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public  function storeFood(Request $request)
    {
        $result = foodService::storeFood($request);

        return response()->json(['message' => $result]);
    }
    public  function updateFood(Request $request,$id)
    {
        $result = foodService::updateFood( $request,$id);

        return response()->json(['message' => $result]);
    }
    public  function foodIngredient($id)
    {
        $result = foodService::foodIngredient($id);

        return response()->json(['message' => $result]);
    }
    public  function deleteFood($id)
    {
        $result = foodService::deleteFood($id);

        return response()->json(['message' => $result]);
    }
    public  function index()
    {
        $result = foodService::index();

        return response()->json(['message' => $result]);
    }
}
