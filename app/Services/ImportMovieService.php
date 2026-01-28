<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Str;

class ImportMovieService
{
    /**
     * todo Import movie from TMDB to the database
     * @param  string  $poster
     * @param  string  $title
     * @param  int  $movieId
     * @return Movie
     */
    public function importMovie(string $poster, string $title, int $movieId): Movie
    {
        return Movie::create([
            'poster' => $poster,
            'title' => $title,
            'tmdb_id' => $movieId,
            'slug' => Str::slug($title),
        ]);
    }
}
