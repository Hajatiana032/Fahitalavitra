<?php

use App\Services\UrlApiService;
use Livewire\Component;

new class extends Component {
    public array $genres = [];
    public string $errorMessage = '';
    public function mount(UrlApiService $urlApiService)
    {
        try {
            $this->genres = $urlApiService->url('https://api.themoviedb.org/3/genre/movie/list')->json('genres');
        } catch (\Throwable $th) {
            $this->errorMessage = 'Impossible de récupérer les genres.';
        }
    }
};
?>
<div>
    @if ($errorMessage)
        <div class="alert alert-soft alert-error text-center">
            {{ $errorMessage }}
        </div>
    @endif
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8">
        @foreach ($genres as $genre)
            <ul class="menu">
                <li><a href="{{ route('genres', ['slug' => Str::slug($genre['name']), 'id' => $genre['id']]) }}"
                        @class([
                            'bg-primary' =>
                                request()->routeIs('genres') && request()->id == $genre['id'],
                        ]) wire:navigate>{{ $genre['name'] }}</a>
                </li>
            </ul>
        @endforeach
    </div>
</div>
