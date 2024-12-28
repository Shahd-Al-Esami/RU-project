<?php

namespace App\Models;

use App\Models\Review;
use App\Models\Suggest;
use App\Models\MealWeek;
use App\Models\PlanOrder;
use App\Models\DescriptionPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $fillable=['title','state','plan_order_id','start_date','end_date'];


    public function review(): MorphOne
    {
        return $this->morphOne(Review::class, 'reviewable')->chaperone();
    }
    public function planOrder(): BelongsTo{
        return $this->belongsTo(PlanOrder::class);
     }
     public function descriptionPlan(): HasOne {
        return $this->hasOne(DescriptionPlan::class);
     }
     public function suggests(): HasMany{
        return $this->hasMany(Suggest::class);
     }
}
