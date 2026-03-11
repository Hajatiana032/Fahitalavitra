<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "poster",
        'backdrop',
        "title",
        "slug",
        "tmdb_id",
        'backdrop',
    ];

    public function projections(): HasMany
    {
        return $this->hasMany(Projection::class);
    }
}
