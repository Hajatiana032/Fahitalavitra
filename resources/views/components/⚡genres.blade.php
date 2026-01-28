<?php

use App\Services\UrlApiService;
use Livewire\Component;

new class extends Component {
    public array $genres = [];
    public function mount(UrlApiService $urlApiService)
    {
        $response = $urlApiService->url('https://api.themoviedb.org/3/genre/movie/list');
        $this->genres = $response->json('genres');
    }
};
?>

<div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8">
    @foreach ($genres as $genre)
        <ul class="menu">
            <li><a href="{{ route('genres', ['slug' => Str::slug($genre['name']), 'id' => $genre['id']]) }}"
                    class="text-center" wire:navigate>{{ $genre['name'] }}</a>
            </li>
        </ul>
    @endforeach
</div>
