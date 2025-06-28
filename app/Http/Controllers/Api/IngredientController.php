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

        return redirect()->back()->with('success', 'تم الانشاء الخطة بنجاح');
    }
    public  function updateingredient(Request $request,$id)
    {
        $result = IngredientService::updateingredient( $request,$id);

        return redirect()->back()->with('success', 'تم الانشاء الخطة بنجاح');
    }
    public  function deleteIngredient($id)
    {
        $result = IngredientService::deleteIngredient($id);

        return redirect()->back()->with('success', 'تم الانشاء الخطة بنجاح');
    }

    public  function index()
    {
        $ingredients = IngredientService::index();

return view('admin.foods',['ingredients'=>$ingredients]);    }
}
