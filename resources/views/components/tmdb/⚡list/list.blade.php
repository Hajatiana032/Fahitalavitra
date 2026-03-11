<div>
    @if (!empty($movies))
        <form>
            <input type="search"
                   class="input mb-2 input-lg"
                   placeholder="Rechercher"
                   wire:model.live.debounce.500ms='search'>
        </form>
        @if ($search)
            <h2 class="text-3xl mb-5">Résultats pour "{{ $search }}"</h2>
        @endif
        <div class="mb-2 text-center">
            @if ($errorMessage)
                <div class="alert alert-error text-center">
                    {{ $errorMessage }}
                </div>
            @endif
            @include('partials._flash-message')
        </div>
        <div class="grid xl:grid-cols-4 gap-2">
            @forelse($movies as $movie)
                <x-movie-card :movie="$movie"/>
            @empty
                <div>Aucun résultat</div>
            @endforelse
        </div>
        <livewire:pagination
            :totalPages="$totalPages"
            route="filament.admin.resources.films.tmdbList"/>
    @endif
</div>
