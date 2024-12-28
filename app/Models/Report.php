<?php

namespace App\Models;

use App\Models\User;
use App\Models\MonthReport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;
    protected $fillable=['plan_id','doctor_id','recommended','filePath','date','description','title','patient_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }

}
