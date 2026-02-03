<?php

use App\Services\UrlApiService;
use Livewire\Component;

new class extends Component
{
    public array $movie = [];
    public int $id;
    public string $errorMessage = '';
    public array $videos = [];

    public function mount(UrlApiService $urlApiService)
    {
        try {
            $this->movie = $urlApiService->url("https://api.themoviedb.org/3/movie/$this->id", null)->json();
            $this->videos = $this->api->url("https://api.themoviedb.org/3/movie/$this->id/videos", null)
                ->json('results');
        } catch (Exception $e) {
            $this->errorMessage = 'Impossible de charger le film.';
        }
    }
};
