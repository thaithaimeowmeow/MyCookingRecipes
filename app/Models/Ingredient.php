<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{

    protected $fillable = [
        'name',
        'quantity',
    ];

    function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
