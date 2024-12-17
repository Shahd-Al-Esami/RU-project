<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','doctor_id','description','isAgree','date'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
}
