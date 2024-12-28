<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $fillable=['reviewable_id','user_id','rate','comment','reviewable_type'];



    public function reviewable(): MorphTo{
        return $this->morphTo();
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
}
