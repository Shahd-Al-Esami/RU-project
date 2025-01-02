<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Bill;
use App\Models\Like;
use App\Models\Note;
use App\Models\Post;
use App\Models\Report;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Suggest;
use App\Models\PlanOrder;
use App\Models\MonthBills;
use App\Models\Appointment;
use App\Models\BlockedUser;
use App\Models\MonthReport;
use App\Models\DoctorHoliday;
use App\Models\DoctorInformation;
use Laravel\Sanctum\HasApiTokens;
use App\Models\PatientInformation;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'country',
        'phone_number',
        'image',
        'gender',
        'role',
        'isAgreeDoctorRegistration',
        'blocked'
    ];

    public function getAuthPasswordName(): string
    {
        return 'password'; // Assuming 'password' is the name of your password field
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function doctorInformation(): HasOne{
        return $this->hasOne(DoctorInformation::class,'doctor_id');
    }
    public function patientInformation(): HasOne{
        return $this->hasOne(PatientInformation::class,'patient_id');
    }

    public function reviews(): MorphToMany
    {
        return $this->morphToMany(Review::class, 'reviewable')->chaperone();
    }
    public function bills(): HasMany{
        return $this->hasMany(Bill::class,'user_id');
    }
    public function reports(): HasMany{
        return $this->hasMany(Report::class);
    }
    public function planOrders(): HasMany{
        return $this->hasMany(PlanOrder::class,'doctor_id',);
    }


    public function posts(): HasMany {
        // $this->role === 'doctor';
     return $this->hasMany(Post::class);

    }
    public function comments(): HasMany {
        // $this->role === 'patient';
     return $this->hasMany(Comment::class);

    }
    public function likes(): HasMany {
        // $this->role === 'patient';
     return $this->hasMany(Like::class);

    }


    public function notes(): HasMany{
        return $this->hasMany(Note::class);
    }

    public function appointments(): HasMany{
        return $this->hasMany(Appointment::class);
    }
    public function suggests(): HasMany{
        return $this->hasMany(Suggest::class);
    }
    public function blockedUsers(): HasMany{
        return $this->hasMany(BlockedUser::class);
    }

    public function doctorHoliday(): HasMany{
        return $this->hasMany(DoctorHoliday::class,'doctor_id');
    }
    public function patients(): BelongsToMany{
        return $this->belongsToMany(User::class,'follows','doctor_id','patient_id');
    }
    public function doctors(): BelongsToMany{
        return $this->belongsToMany(User::class,'follows','patient_id','doctor_id');
    }
    public function monthBills(): HasMany{
        return $this->hasMany(MonthBills::class);
    }

}
