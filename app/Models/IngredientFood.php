<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientFood extends Model
{
    use HasFactory;
    protected $fillable=['unit','quantity','ingredient_id','food_id'];
    protected $table='ingredient_food';

}
