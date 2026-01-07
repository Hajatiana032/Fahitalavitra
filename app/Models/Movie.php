<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @method static firstOrCreate(array $array)
 */
class Movie extends Model
{
    use Searchable;

    protected $fillable = ['title', 'slug', 'image', 'synopsis'];

    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'synopsis' => $this->synopsis,
        ];
    }
}
