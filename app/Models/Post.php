<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['doctor_id','title','description','image','link_source'];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
     }
     public function fans(): BelongsToMany{
        return $this->belongsToMany(User::class,'likes','post_id','user_id');
    }
    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }
    public function likes(): HasMany{
        return $this->hasMany(Like::class);
    }
}
