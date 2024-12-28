<?php

namespace App\Models;

use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\DescriptionPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;
    protected $fillable=['name','calories','ingredient_ids[]',];
    protected $table='foods';

     public function ingredients(): BelongsToMany{
        return $this->belongsToMany(Ingredient::class,'ingredient_food','food_id','ingredient_id');
     }


     public function descriptionPlan(): BelongsTo{
        return $this->belongsTo(DescriptionPlan::class);
     }

}
