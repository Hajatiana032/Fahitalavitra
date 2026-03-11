@php use App\Filament\Resources\Movies\MovieResource;use Carbon\Carbon; @endphp
<div>
    @if ($errorMessage)
        <div class="alert alert-soft alert-error text-center">
            {{ $errorMessage }}
        </div>
        @if (request()->routeIs('filament.admin.*'))
            <div class="text-center">
                <button href="{{ route('filament.admin.resources.films.index') }}"
                        class="btn btn-soft btn-lg btn-primary mt-3"
                        wire:navigate>
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Retour
                </button>
            </div>
        @endif
    @endif
    @if ($successMessage)
        <div class="alert alert-soft alert-success text-center mb-5">
            {{ $successMessage }}
        </div>
    @endif
    @if (!empty($movie))
        @if (request()->routeIs('filament.admin.*'))
            <div class="ms-auto mb-3">
                <button href="{{ MovieResource::getUrl('tmdbList') }}"
                        class="btn btn-primary"
                        wire:navigate>Voir la liste sur TMDB
                </button>
                <button href="{{ MovieResource::getUrl('index') }}"
                        class="btn btn-soft
    btn-secondary"
                        wire:navigate>Liste des films enregistrés
                </button>
            </div>
        @endif
        <div class="card image-full">
            <figure>
                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['backdrop_path'] }}"
                     alt="{{ $movie['title'] }}"
                     class="w-full">
            </figure>
            <div class="card-body">
                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-4">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                             alt="{{ $movie['title'] }}"
                             class="rounded-2xl">
                    </div>
                    <div class="col-span-8">
                        <h1 class="text-4xl font-bold">{{ $movie['title'] }}</h1>
                        @foreach ($movie['genres'] as $genre)
                            <span class="badge badge-soft badge-success">{{ $genre['name'] }}</span>
                        @endforeach
                        <p class="mt-5">
                            Pays d'origine:
                            @foreach ($movie['production_countries'] as $country)
                                <span class="badge badge-soft badge-success">{{ $country['name'] }}</span>
                            @endforeach
                        </p>
                        <p class="mt-5">
                            Studios:
                            @foreach ($movie['production_companies'] as $company)
                                <span class="badge badge-soft badge-success">{{ $company['name'] }}</span>
                            @endforeach
                        </p>
                        <p class="mt-5">Date de sortie:
                            <span
                                class="badge badge-soft badge-success">{{ Carbon::parse($movie['release_date'])->format('d-M-Y') }}</span>
                            <span class="badge badge-soft badge-info">
                                {{ $movie['status'] }}
                            </span>
                        </p>
                        <p class="mt-5">Durée:
                            <span class="badge badge-soft badge-success">{{ $movie['runtime'] }} min</span>
                        </p>
                        <p class="mt-5">
                            Moyenne:
                            <span class="badge badge-soft badge-success">
                                {{ round($movie['vote_average']) }} / 10
                            </span>
                        </p>
                        <p class="mt-5">
                            <span class="font-bold text-2xl">Synopsis:</span> <br/>
                            {{ $movie['overview'] }}
                        </p>
                        <div class="mt-3"
                             x-data="{ show: false }">
                            @if (!empty($videos))
                                <button type="button"
                                        class="btn btn-soft btn-success"
                                        aria-haspopup="dialog"
                                        aria-expanded="false"
                                        aria-controls="basic-modal"
                                        data-overlay="#basic-modal"
                                        x-on:click="show=true;HSOverlay.open($refs.modal)">
                                    <i class="fa fa-video"></i>
                                    Extrait vidéo
                                </button>
                            @endempty
                            @if (request()->routeIs('filament.admin.resources.films.tmdbList'))
                                <button class="btn btn-soft btn-secondary"
                                        wire:click="importMovie">
                                    <i class="far fa-arrow-alt-circle-down"></i>
                                    Importer
                                </button>
                            @endif
                            <div class="overlay modal overlay-open:opacity-100
                                 overlay-open:duration-300 [--overlay-backdrop:static]
                                 hidden"
                                 role="dialog"
                                 tabindex="-1"
                                 x-ref="modal">
                                <template x-if="show">
                                    <div class="modal-dialog modal-dialog-lg rounded-lg">
                                        <div class="modal-content">
                                            <div class="modal-header p-0">
                                                <button type="button"
                                                        class="btn btn-primary btn-circle btn-sm absolute end-3 top-3"
                                                        aria-label="Close"
                                                        x-on:click="show=false;HSOverlay.close($refs
                                                        .modal)">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0 rounded-lg">
                                                @foreach ($videos as $video)
                                                    @if ($video['type'] === 'Trailer')
                                                        <iframe
                                                            src="https://www.youtube.com/embed/{{ $video['key'] }}"
                                                            class="aspect-video h-96 w-full"></iframe>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
