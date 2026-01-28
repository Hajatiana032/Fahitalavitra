<?php

use App\Models\Movie;
use App\Services\ImportMovieService;
use App\Services\UrlApiService;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component implements HasSchemas {
    use InteractsWithSchemas;

    public array $movies = [];
    #[Url]
    public int $page = 1;
    #[Url]
    public string $search = '';

    public string $errorMessage = '';

    public string $successMessage = '';
    public int $totalPages = 1;


    public function mount(UrlApiService $api): void
    {
        try {
            $this->fetchMovies($api);
        } catch (Throwable $e) {
            $this->errorMessage = "Une erreur est survenue, impossible d'afficher la liste des films 😓.";
        }
    }

    public function fetchMovies(UrlApiService $api): void
    {
        if ($this->search !== '') {
            $response = $api->url("https://api.themoviedb.org/3/search/movie", [
                'query' => $this->search,
                'page' => $this->page,
            ]);
        } else {
            $response = $api->url("https://api.themoviedb.org/3/movie/popular", ['page' => $this->page]);
        }
        $this->movies = $response->json('results');
        $this->totalPages = min($response->json('total_pages') ?? 1, 500);
    }

    #[On('page-changed')]
    public function onPageChanged(int $page, UrlApiService $api): void
    {
        $this->page = $page;
        $this->fetchMovies($api);
    }

    public function updatedSearch(UrlApiService $api): void
    {
        $this->page = 1;
        $this->fetchMovies($api);
        $this->dispatch('scroll-to-top');
    }

    /**
     * @return Movie
     */
    public function importMovie(ImportMovieService $importMovieService, int $id): Movie
    {
        $movie = collect($this->movies)->firstWhere('id', $id);
        $currentMovie = Movie::where('tmdb_id', $id)->first();
        if ($currentMovie) {
            $this->errorMessage = 'Le film "' . $movie['title'] . '" a déjà été importé.';
            $this->dispatch('scroll-to-top');
            return $currentMovie;
        }
        if (!$movie) {
            throw new \Exception('Film non trouvé dans la liste actuelle.');
        }
        $importedMovie = $importMovieService->importMovie($movie['poster_path'], $movie['title'], $id);
        $this->successMessage = 'Film "' . $movie['title'] . '" importé avec succès !';
        $this->dispatch('scroll-to-top');
        return $importedMovie;
    }
};
