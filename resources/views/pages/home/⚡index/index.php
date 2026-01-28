<?php

use App\Services\UrlApiService;
use Livewire\Component;
use Soap\Url;

new class extends Component {
    public array $popularMovies = [];
    public string $errorMessage = '';

    public function mount(UrlApiService $urlApiService)
    {
        try {
            $this->popularMovies($urlApiService);
        } catch (\Exception $e) {
            $this->errorMessage = 'Impossible de récupérer les films pour le moment.';
        }
    }

    public function popularMovies(UrlApiService $urlApiService)
    {
        $response = $urlApiService->url('https://api.themoviedb.org/3/movie/popular');
        $this->popularMovies = $response->json('results');
    }
};
