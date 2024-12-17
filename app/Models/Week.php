<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Week extends Model
{
    use HasFactory;
    protected $fillable=['number'];
    public function meals(): BelongsToMany{
        return $this->belongsToMany(Meal::class,'meal_weeks','week_id','meal_id');
     }

}
