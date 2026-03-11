<div>
    @if ($errorMessage)
        <div class="alert alert-soft alert-error text-center">
            {{ $errorMessage }}
        </div>
    @else
        <h1 class="text-4xl mb-5">Prochainement</h1>
        <x-carousel :movies="$upcomingMovies" />
        <h1 class="text-4xl mt-5 mb-5">Les plus populaires</h1>
        <x-carousel :movies="$popularMovies" />
        <h1 class="text-4xl mb-5 mt-5">Les mieux notés</h1>
        <x-carousel :movies="$topRatedMovies" />
    @endif
</div>
