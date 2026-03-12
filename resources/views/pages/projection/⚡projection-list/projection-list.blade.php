<div class="container mx-auto px-4 py-8">
    <div class="mb-8 p-6 bg-base-200 rounded-box shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold flex items-center gap-2">
                <i class="fa fa-filter"></i>
                Filtrer les projections
            </h2>
            @if($movieTitle || $date)
                <button
                    wire:click="resetFilters"
                    class="btn btn-ghost btn-sm text-error"
                >
                    <i class="fa fa-times"></i>
                    Réinitialiser les filtres
                </button>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="form-control">
                <label class="label">
                    <span class="label-text flex items-center gap-1">
                        <i class="fa fa-film"></i>
                        Titre du film
                    </span>
                </label>
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live.debounce.500ms="movieTitle"
                        placeholder="Rechercher un film..."
                        class="input input-bordered w-full pr-10"
                    />
                    @if($movieTitle)
                        <button
                            wire:click="$set('movieTitle', null)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-error"
                        >
                            <i class="fa fa-times-circle"></i>
                        </button>
                    @endif
                </div>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text flex items-center gap-1">
                        <i class="fa fa-calendar"></i>
                        Date
                    </span>
                </label>
                <div class="relative">
                    <input
                        type="date"
                        wire:model.live="date"
                        class="input input-bordered w-full"
                        min="{{ now()->format('Y-m-d') }}"
                    />
                    @if($date)
                        <button
                            wire:click="$set('date', null)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-error"
                        >
                            <i class="fa fa-times-circle"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        @if($movieTitle || $date)
            <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-base-300">
                <span class="text-sm opacity-70 mr-2">Filtres actifs:</span>

                @if($movieTitle)
                    <span class="badge badge-primary gap-1 py-3">
                        <i class="fa fa-film"></i>
                        {{ $movieTitle }}
                        <button wire:click="$set('movieTitle', null)"
                                class="ml-1 hover:text-error">
                            <i class="fa fa-times-circle"></i>
                        </button>
                    </span>
                @endif

                @if($date)
                    <span class="badge badge-accent gap-1 py-3">
                        <i class="fa fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                        <button wire:click="$set('date', null)"
                                class="ml-1 hover:text-error">
                            <i class="fa fa-times-circle"></i>
                        </button>
                    </span>
                @endif
            </div>
        @endif
    </div>
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
