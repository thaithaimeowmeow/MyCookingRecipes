<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
