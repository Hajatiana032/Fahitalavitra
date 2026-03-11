<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">
        @if($projections->isEmpty())
            Aucun projection disponible
        @else
            Projections disponible
        @endif
    </h1>
    <div class="mb-4">
        @include('partials._flash-message')
    </div>

    @foreach($projections as $projection)
        <div class="card text-white h-75 overflow-auto shadow-lg duration-300 ease-in-out
                          hover:shadow-primary/50 mb-5 transition-transform hover:-translate-y-2">
            <img src="https://image.tmdb.org/t/p/w500{{ $projection->movie->backdrop }}"
                 alt="{{ $projection->movie->title }}"
                 class="object-cover absolute w-full h-75"/>
            <div class="card-body z-0 bg-black/75">
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <p class="text-2xl font-bold">
                            {{ $projection->movie->title }}
                        </p>
                        <p class="mt-5 mb-3">
                            <i class="fa fa-building-circle-arrow-right"></i>Salle: {{ $projection->room }}
                        </p>
                        <p class="mb-3">
                            <i class="far fa-calendar"></i>
                            Date et heure:
                            {{ $projection->start_at->format('d-M-Y à H:i') }}
                        </p>
                        <p class="mb-3">
                            <i class="fa fa-money-bill"></i>
                            Prix: {{ Number::currency($projection->price, 'MGA', 'fr_MG') }}
                        </p>
                        <p>
                            <i class="fa fa-ticket"></i>
                            Billet disponible: {{ $projection->max_tickets }}
                        </p>
                    </div>
                    <div class="justify-end flex gap-1">
                        <button href="{{ route('movie.show', ['slug' => \Illuminate\Support\Str::slug
                        ($projection->movie->title), 'id' => $projection->movie->tmdb_id]) }}"
                                class="btn
                        btn-info waves"
                                wire:navigate>Info sur le film
                        </button>
                        <button class="btn btn-primary waves"
                                aria-haspopup="dialog"
                                aria-expanded="false"
                                aria-controls="{{ $projection->id }}"
                                data-overlay="#modal-{{ $projection->id }}">Acheter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <livewire:order-form :id="$projection->id"
                             :title="$projection->movie->title"/>
    @endforeach
</div>
