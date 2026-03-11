<?php

use App\Models\Movie;
use App\Services\ImportMovieService;
use App\Services\UrlApiService;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
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

    public int $totalPages = 1;


    public function mount(UrlApiService $api): void
    {
        try {
            $this->fetchMovies($api);
        } catch (Throwable) {
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

    public function updatedSearch(UrlApiService $api): void
    {
        $this->page = 1;
        $this->fetchMovies($api);
        $this->dispatch('scroll-to-top');
    }

    /**
     * @param  ImportMovieService  $importMovieService
     * @param  int  $id
     * @return void
     */
    public function importMovie(ImportMovieService $importMovieService, int $id): void
    {
        $movie = collect($this->movies)->firstWhere('id', $id);
        $currentMovie = Movie::where('tmdb_id', $id)->first();
        if ($currentMovie) {
            session()->flash('error', 'Le film "'.$currentMovie->title.'" est déjà présent dans la base de données !');
        } else {
            $importMovieService->importMovie($movie['poster_path'], $movie['backdrop_path'], $movie['title'], $id);
            session()->flash('primary', 'Le film "'.$movie['title'].'" a été importé avec succès !');
        }
        $this->redirectRoute('filament.admin.resources.films.tmdbList', ['page' => $this->page], navigate: true);
    }
};
