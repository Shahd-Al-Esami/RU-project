<?php

namespace App\Models;

use App\Models\Meal;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;
    protected $fillable=['name','calories'];
    public function meals(): BelongsToMany{
        return $this->belongsToMany(Meal::class,'food_meals','food_id','meal_id');
     }
     public function ingredients(): BelongsToMany{
        return $this->belongsToMany(Ingredient::class,'ingredient_food','food_id','ingredient_id');
     }

}
