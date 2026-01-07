@php
    $routeName = request()->route()->getName();
@endphp
<nav class="navbar shadow-base-300/20 shadow-sm bg-primary sticky top-0 z-[50]">
    <div class="w-full lg:flex lg:items-center md:gap-2">
        <div class="flex items-center justify-between">
            <div class="navbar-start items-center justify-between max-lg:w-full">
                <a class="text-base-content link-neutral text-xl font-bold no-underline flex gap-2" href="{{
                route
                ('home.index')
                }}" wire:navigate>
                    <img src="{{ asset('logo-white.png') }}" alt="logo" width="30">
                    Fahitalavitra
                </a>
                <div class="lg:hidden">
                    <button type="button" class="collapse-toggle btn-sm btn-square btn-primary btn"
                            data-collapse="#default-navbar-collapse" aria-controls="default-navbar-collapse"
                            aria-label="Toggle navigation">
                        <x-heroicon-o-bars-3/>
                    </button>
                </div>
            </div>
        </div>
        <div id="default-navbar-collapse"
             class="lg:navbar-end collapse hidden grow basis-full overflow-hidden transition-[height] duration-300
             max-lg:w-full">
            <ul class="menu lg:menu-horizontal gap-2 p-0 text-base max-lg:mt-2 text-lg">
                @livewire('search-form')
                <li>
                    <a href="{{ route('home.index') }}"
                       class="hover:bg-neutral-content"
                       wire:navigate>Accueil</a>
                </li>
                <li>
                    <a href="{{ route('search.index') }}?q=&filter=en_salle"
                       class="hover:bg-neutral-content duration-700 ease-in-out"
                       wire:navigate>
                        Actuellement en salle
                    </a>
                </li>
                <li><a href="#" class="hover:bg-neutral-content">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
