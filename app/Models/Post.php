<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'video',
        'totalTime',
        'prepTime',
        'cookTime',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function steps(): HasMany
    {
        return $this->hasMany(related: Step::class);
    }

    function ingredients(): HasMany
    {
        return $this->hasMany(related: Ingredient::class);
    }
    function tags(): BelongsToMany
    {
        return $this->belongsToMany(related: Tag::class);
    }
}
