<?php

namespace App\Models;

use App\Models\User;
use App\Models\PlanOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=['payment_method','planOrder_id','user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id');
     }
     public function planOrder(): BelongsTo{
        return $this->belongsTo(PlanOrder::class,'planOrder_id');
     }
}
