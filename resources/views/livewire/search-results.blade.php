@php
    $filter = request()->filter;
@endphp
<div class="mb-5">
    <div class="grid grid-cols-2 xl:grid-cols-4 mt-5 gap-2">
        @forelse($movies as $movie)
            <div class="card glass group bg-primary/20 shadow shadow-md hover:shadow-primary duration-700 text-primary-content
                sm:max-w-sm relative">
                <figure>
                    <img
                        src="{{ $filter !== 'tmdb' ? asset('storage/'.$movie->image) : 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}"
                        alt="{{ $filter !== 'tmdb' ? $movie->slug : $movie['title'] }}" class="transition-transform
                         duration-500
                         group-hover:scale-110"/>
                </figure>
                <div class="card-header">
                    <h5 class="card-title text-primary-content">
                        {{ $filter !== 'tmdb' ? $movie->title : $movie['title'] }}
                    </h5>
                </div>
                <div class="card-body">
                    <p class="">
                        {{ $filter !== 'tmdb' ? \Illuminate\Support\Str::limit($movie->synopsis,150) :
                    \Illuminate\Support\Str::limit($movie['overview'],150) }}
                    </p>
                    <div class="card-actions">
                        <button class="btn btn-primary">Plus d'infos</button>
                        @if($filter !== 'tmdb')
                            <button class="btn btn-accent">Acheter vos billets</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-soft alert-error text-center" role="alert">
                Aucun résultat
            </div>
        @endforelse
    </div>
    @if($filter !== 'tmdb')
        {{ $movies->links() }}
    @endif
</div>
