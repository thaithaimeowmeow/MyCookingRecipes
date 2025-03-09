<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Overtrue\LaravelLike\Traits\Likeable;

class Post extends Model
{
    use Likeable;
    

    protected $fillable = [
        'name',
        'slug',
        'yields',
        'description',
        'image',
        'video',
        'totalTime',
        'prepTime',
        'cookTime',
        'isApproved',
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
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    function reports(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

}
