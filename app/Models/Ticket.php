<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'movie_id',
        'theater',
        'date',
        'time',
        'stock',
        'price',
    ];

    public function movie(): belongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function getStocksAttribute(): string
    {
        return $this->stock.'/50';
    }
}
