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

        return redirect()->back()->with('success', 'تم الانشاء الخطة بنجاح');
    }
    public  function updateFood(Request $request,$id)
    {
        $result = FoodService::updateFood( $request,$id);

        return redirect()->back()->with('success', 'تم الانشاء الخطة بنجاح');
    }
    public  function foodIngredient($id)
    {
        $result = FoodService::foodIngredient($id);

        return response()->json(['message' => $result]);
    }
    public  function deleteFood($id)
    {
        $result = FoodService::deleteFood($id);

        return redirect()->back()->with('success', 'تم الانشاء الخطة بنجاح');
    }
    public  function index()
    {
        $foods = FoodService::index();

return view('admin.foods',['foods'=>$foods]);    }
}
