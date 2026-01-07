<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home.index', [
            'populars' => $this->popularMovies(),
            'upcoming' => $this->upcomingMovies(),
            'topRated' => $this->topRatedMovies(),
            'trending' => $this->trendingMovies(),
        ]);
    }

    public function popularMovies()
    {
        return $this->urlApi(
            'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc'
        );
    }

    public function urlApi(string $url)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.tmdb.api_key'),
        ])->get($url)->json('results');
    }

    public function upcomingMovies()
    {
        return $this->urlApi('https://api.themoviedb.org/3/movie/upcoming?language=en-US&page=1');
    }

    public function topRatedMovies()
    {
        return $this->urlApi('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1');
    }

    public function trendingMovies()
    {
        return $this->urlApi('https://api.themoviedb.org/3/trending/movie/day?language=en-US');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
