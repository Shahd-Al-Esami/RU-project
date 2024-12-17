<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockedUser extends Model
{
    use HasFactory;
    protected $fillable=['user_id','blockExpires_at','reason'];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
}
