<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientInformation extends Model
{
    use HasFactory;
    protected $fillable=[
        'height','weight','answers','patient_id','desirable_foods','health_state','financial_state'

    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
}
