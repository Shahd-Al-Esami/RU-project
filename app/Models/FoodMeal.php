<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMeal extends Model
{
    use HasFactory;
    protected $fillable=['food_id','meal_id','plan_order_id'];

}
