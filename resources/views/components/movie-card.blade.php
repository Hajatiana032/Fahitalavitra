<div class="card">
    <figure>
        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="">
    </figure>
    <div class="card-header">
        <h1 class="card-title">{{ \Illuminate\Support\Str::limit($movie['title'], 15) }}</h1>
    </div>
    <div class="card-body space-y-3">
        <p>{{ \Illuminate\Support\Str::limit($movie['overview'], 75) }}</p>
        <div class="card-actions ms-auto">
            @if (request()->routeIs('filament.*'))
                <div class="tooltip">
                    <a href="{{ \App\Filament\Resources\Movies\MovieResource::getUrl('movieInfo', ['record' => $movie['id']]) }}"
                        class="btn btn-soft btn-warning tooltip-toggle" aria-label="tooltip" wire:navigate>
                        <i class="fa fa-info-circle"></i>
                    </a>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body tooltip-warning">Plus d'infos</span>
                    </span>
                </div>
                <div class="tooltip">
                    <button
                        class="btn
                            btn-soft
                            btn-primary tooltip-toggle"
                        aria-label="tooltip" wire:click="importMovie({{ $movie['id'] }})">
                        <i class="far fa-arrow-alt-circle-down"></i>
                    </button>
                    <span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
                        <span class="tooltip-body tooltip-primary">Importer</span>
                    </span>
                </div>
            @else
                <a href="{{ route('movie.show', ['slug' => Str::slug($movie['title']), 'id' => $movie['id']]) }}"
                    class="btn btn-soft btn-info" wire:navigate>Plus d'infos</a>
            @endif
        </div>
    </div>
</div>
