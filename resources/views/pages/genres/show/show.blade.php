<div>
    <h1 class="text-4xl mb-5 font-bold">{{ $genreName }}</h1>
    <div class="grid grid-cols-4 gap-3">
        @foreach ($movies as $movie)
            <x-movie-card :movie="$movie" />
        @endforeach
    </div>
    <livewire:pagination :page="$page" :totalPages="$totalPages" />
</div>
