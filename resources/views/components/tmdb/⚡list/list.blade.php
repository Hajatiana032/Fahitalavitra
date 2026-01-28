<div>
    @if ($errorMessage)
        <div class="alert alert-soft alert-error text-center mb-5">
            {{ $errorMessage }}
        </div>
    @endif
    @if (!empty($movies))
        <form>
            <input type="search" class="input mb-2 input-lg" placeholder="Rechercher"
                wire:model.live.debounce.500ms='search'>
        </form>
        @if ($search)
            <h2 class="text-3xl mb-5">Résultats pour "{{ $search }}"</h2>
        @endif
        @if ($successMessage)
            <div class="alert alert-soft alert-success text-center mb-5">
                {{ $successMessage }}
            </div>
        @endif
        <div class="grid xl:grid-cols-4 gap-2">
            @forelse($movies as $movie)
                <x-movie-card :movie="$movie" />
            @empty
                <div>Aucun résultat</div>
            @endforelse
        </div>
        <livewire:pagination :page="$page" :totalPages="$totalPages" />
    @endif
</div>
