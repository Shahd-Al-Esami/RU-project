<?php

namespace App\Models;

use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthReport extends Model
{
    use HasFactory;
    protected $fillable=['filePath','status','date'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
     public function reports(): HasMany{
        return $this->hasMany(Report::class);
     }
}
