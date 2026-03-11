<?php

use App\Services\UrlApiService;
use Livewire\Component;

new class extends Component {
    public array $popularMovies = [];
    public array $topRatedMovies = [];
    public array $upcomingMovies = [];
    public string $errorMessage = '';

    public function mount(UrlApiService $urlApiService)
    {
        try {
            $this->popularMovies($urlApiService);
            $this->topRatedMovies($urlApiService);
            $this->upcomingMovies($urlApiService);
        } catch (\Exception $e) {
            $this->errorMessage = 'Impossible de récupérer les films pour le moment.';
        }
    }

    public function popularMovies(UrlApiService $urlApiService): void
    {
        $this->popularMovies = $urlApiService->url('https://api.themoviedb.org/3/movie/popular')->json('results');
    }

    public function topRatedMovies(UrlApiService $urlApiService): void
    {
        $this->topRatedMovies = $urlApiService->url('https://api.themoviedb.org/3/movie/top_rated')->json('results');
    }

    public function upcomingMovies(UrlApiService $urlApiService): void
    {
        $this->upcomingMovies = $urlApiService->url('https://api.themoviedb.org/3/movie/upcoming')->json('results');
    }
};
