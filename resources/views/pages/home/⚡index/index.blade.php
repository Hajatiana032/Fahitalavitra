<div>
    @if ($errorMessage)
        <div class="alert alert-soft alert-error text-center">
            {{ $errorMessage }}
        </div>
    @endif
    <h1 class="text-4xl mb-5">Les plus populaires</h1>
    <x-carousel :movies="$popularMovies" />
</div>