<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    //
    protected $fillable = ['content', 'user_id', 'post_id','type','status'];

    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
