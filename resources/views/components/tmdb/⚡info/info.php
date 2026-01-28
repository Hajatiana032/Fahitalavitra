<?php

use App\Models\Movie;
use App\Services\ImportMovieService;
use App\Services\UrlApiService;
use Livewire\Component;

new class extends Component {
    public int $id;
    public array $movie;

    public string $errorMessage = '';

    public string $successMessage = '';

    protected UrlApiService $api;

    public array $videos;


    /**
     * @param  UrlApiService  $api
     * @param  ImportMovieService  $importMovieService
     * @return void
     */
    public function mount(UrlApiService $api): void
    {
        $this->api = $api;
        $this->currentMovie();
    }

    /**
     * @return void
     */
    public function currentMovie(): void
    {
        try {
            $response = $this->api->url("https://api.themoviedb.org/3/movie/$this->id", null);
            $this->movie = $response->json();
            $this->videos = $this->api->url("https://api.themoviedb.org/3/movie/$this->id/videos", null)
                ->json('results');
        } catch (Exception $exception) {
            $this->movie = [];
            $this->errorMessage = "Une erreur s'est produite. Impossible de récupérer les information sur ce film 😓.";
        }
    }

    /**
     * @return Movie
     */
    public function importMovie(ImportMovieService $importMovieService): Movie
    {
        $currentMovie = Movie::where('tmdb_id', $this->id)->first();
        if ($currentMovie) {
            $this->errorMessage = 'Le film "' . $this->movie['title'] . '" a déjà été importé.';
            return $currentMovie;
        }
        $importedMovie =   $importMovieService->importMovie($this->movie['poster_path'], $this->movie['title'], $this->id);
        $this->successMessage = 'Film "' . $this->movie['title'] . '" importé avec succès !';
        return $importedMovie;
    }
};
