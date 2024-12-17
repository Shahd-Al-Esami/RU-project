<?php

namespace App\Models;

use App\Models\Food;
use App\Models\Week;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meal extends Model
{
    protected $fillable=['name'];

    use HasFactory;
    public function weeks(): BelongsToMany{
        return $this->belongsToMany(Week::class,'meal_weeks','meal_id','week_id');
     }
     public function foods(): BelongsToMany{
        return $this->belongsToMany(Food::class,'food_meals','meal_id','food_id');
     }
}
