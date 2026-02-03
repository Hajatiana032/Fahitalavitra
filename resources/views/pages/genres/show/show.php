<?php

use App\Services\UrlApiService;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component {
    #[Url()]
    public int $page = 1;
    public int $totalPages = 1;
    public array $movies = [];
    public string $genreName = '';
    public int $id;
    public string $errorMessage = '';

    public function mount(UrlApiService $urlApiService, int $id): void
    {
        try {
            $this->id = $id;
            $this->getMovies($urlApiService);
        } catch (Exception $e) {
            $this->errorMessage = 'Une erreur est survenue lors du chargement des films.';
        }
    }

    public function getMovies(UrlApiService $urlApiService)
    {
        $response = $urlApiService->url("https://api.themoviedb.org/3/genre/{$this->id}/movies", ['page' => $this->page]);
        $genreName = $urlApiService->url('https://api.themoviedb.org/3/genre/movie/list');
        $this->genreName = collect($genreName->json('genres'))
            ->firstWhere('id', $this->id)['name'] ?? 'Genre inconnu';
        $this->movies = $response->json('results') ?? [];
        $this->totalPages = min($response->json('total_pages') ?? 1, 500);
    }

    #[On('page-changed')]
    public function onPageChanged(int $page, UrlApiService $urlApiService): void
    {
        $this->page = $page;
        $this->getMovies($urlApiService);
    }
};
