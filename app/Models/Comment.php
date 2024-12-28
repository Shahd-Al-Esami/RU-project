<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','post_id','description','replyComment_id'];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo{
        return $this->belongsTo(Post::class);
    }
}
