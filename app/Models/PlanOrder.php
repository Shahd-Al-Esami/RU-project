<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanOrder extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','description','doctor_id','goals','isPaid','price'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
     public function plan(): HasOne {
        return $this->hasOne(Plan::class);
     }
}
