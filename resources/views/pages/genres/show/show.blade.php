<div>
    @if ($errorMessage)
        <div class="alert alert-soft alert-error text-center">
            {{ $errorMessage }}
        </div>
    @endif
    <h1 class="text-4xl mb-5 font-bold">{{ $genreName }}</h1>
    <div class="grid grid-cols-4 gap-3">
        @foreach ($movies as $movie)
            <x-movie-card :movie="$movie"/>
        @endforeach
    </div>
    <div class="mb-2">
        <livewire:pagination :page="$page"
                             :totalPages="$totalPages"
                             route="genres"
                             :params="['slug'=>\Illuminate\Support\Str::slug($genreName),'id'=> request()->id]"
        />
    </div>
</div>
