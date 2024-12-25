<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthBills extends Model
{
    use HasFactory;
    protected $fillable=['isPaid','billing_date','user_id','price'];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
