<?php

namespace App\Livewire;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SearchResults extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $q = '';

    #[Url]
    public string $filter = 'en_salle';


    public function render(Request $request): View
    {
        $movies = Movie::search($this->q)->paginate(10);
        if ($this->filter === 'tmdb') {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('services.tmdb.api_key'),
            ])->get("https://api.themoviedb.org/3/search/movie?query={$this->q}");
            $movies = $response->json('results') ?? [];
        }

        return view('livewire.search-results', ['movies' => $movies]);
    }
}
