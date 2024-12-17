<?php

namespace App\Models;

use App\Models\Food;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable=['name','calories',];
    public function foods(): BelongsToMany{
        return $this->belongsToMany(Food::class,'ingredient_food','ingredient_id','food_id');
     }

}
