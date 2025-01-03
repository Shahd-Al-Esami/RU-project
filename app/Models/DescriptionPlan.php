<?php

namespace App\Models;

use App\Models\Food;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DescriptionPlan extends Model
{
    use HasFactory;
    protected $table='description_plan';
    protected $fillable=['meal','week','isDone','day','plan_id','food_id'];

    public function plan(): BelongsTo{
        return $this->belongsTo(Plan::class);
     }

     public function food(): HasOne{
        return $this->hasOne(Food::class,);
     }
}
