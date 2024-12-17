<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealWeek extends Model
{
    use HasFactory;
    protected $fillable=['meal_id','week_id','isDone'];
    public function plan(): BelongsTo{
        return $this->belongsTo(Plan::class);
     }
}
