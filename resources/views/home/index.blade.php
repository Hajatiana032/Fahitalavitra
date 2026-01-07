@extends('welcome')

@section('content')
    <div class="grid grid-cols-12 gap-10">
        <div class="col-span-full md:col-span-8 lg:col-span-8">
            <h1 class="text-4xl font-bold mt-5 mb-5 text-shadow-secondary">Prochainement</h1>
            <x-carousel-movies :movies="$upcoming"/>
            <h1 class="text-4xl font-bold mt-5 mb-5">Populaire en ce moment</h1>
            <x-carousel-movies :movies="$populars"/>
            <h1 class="text-4xl font-bold mt-5 mb-5">Les mieux notés</h1>
            <x-carousel-movies :movies="$topRated"/>
        </div>
        <div class="col-span-full md:col-span-4 lg:col-span-4">
            <h1 class="text-4xl font-bold mt-5 mb-5">Tendances</h1>
            <div class="grid sm:grid-cols-2 md:grid-cols-1 sm:gap-2 md:h-[75vh] overflow-auto">
                @foreach($trending as $movie)
                    <div class="card m-auto glass rounded-4xl bg-primary/20 text-primary-content sm:max-w-sm mb-2">
                        <figure>
                            <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                                 alt="{{$movie['title'] }}"/>
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title mb-2.5 text-primary-content">{{ $movie['title'] }}</h2>
                            <p class="mb-4">{{ \Illuminate\Support\Str::limit($movie['overview'],150) }}</p>
                            <div class="card-actions">
                                <button class="btn btn-secondary">Plus d'infos</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h1 class="text-4xl font-bold mt-5 mb-5">Contact</h1>
            <div class="card shadow-primary shadow-sm">
                <div class="card-body">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <label class="label-text text-[15px]" for="name">Nom et prénom</label>
                        <input type="text" class="input @error('name') is-invalid @enderror" name="name" id="name"/>
                        <label class="label-text text-[15px] mt-5" for="phone">Numéro de
                            téléphone</label>
                        <input type="tel" class="input @error('phone') is-invalid @enderror" name="phone" id="phone"/>
                        <label class="label-text text-[15px] mt-5" for="email">Adresse email</label>
                        <input type="email" class="input @error('email') is-invalid @enderror" name="email" id="email"/>
                        <label class="label-text text-[15px] mt-5" for="subject">Sujet</label>
                        <input type="text" class="input @error('subject') is-invalid @enderror" name="subject"
                               id="subject"/>
                        <label class="label-text text[15px] mt-5" for="message"> Votre message </label>
                        <textarea class="textarea resize-none @error('message') is-invalid @enderror" rows="5"
                                  name="message"
                                  id="message"></textarea>
                        <div class="flex">
                            <button type="submit" class="btn btn-primary ms-auto flex">
                                Envoyer
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
