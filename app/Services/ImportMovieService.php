<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Str;

class ImportMovieService
{
    /**
     * todo Import movie from TMDB to the database
     * @param  string  $poster
     * @param  string  $backdrop
     * @param  string  $title
     * @param  int  $movieId
     * @return Movie
     */
    public function importMovie(string $poster, string $backdrop, string $title, int $movieId): Movie
    {
        return Movie::create([
            'poster' => $poster,
            'backdrop' => $backdrop,
            'title' => $title,
            'tmdb_id' => $movieId,
            'slug' => Str::slug($title),
        ]);
    }
}
