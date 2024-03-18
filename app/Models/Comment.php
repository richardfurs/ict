<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['text', 'user_id', 'post_id'];
    
    use HasFactory;

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
