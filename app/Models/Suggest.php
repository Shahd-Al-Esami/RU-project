<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggest extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','plan_id','suggest'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
     public function plan(): BelongsTo{
        return $this->belongsTo(Plan::class);
     }
}
