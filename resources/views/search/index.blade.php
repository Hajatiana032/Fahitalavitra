@extends('welcome')

@section('content')
    <h1 class="text-4xl mt-5 font-bold">Résultats</h1>
    @if(request()->filter === 'en_salle')
        <h2 class="text-3xl font-semibold">Actuellement en salle</h2>
    @elseif(request()->filter === 'tmdb')
        <h2 class="text-3xl font-semibold">Depuis TheMovieDatabase</h2>
    @endif
    <livewire:search-results/>
@endsection
