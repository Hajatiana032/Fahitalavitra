<form wire:submit="search" class="m-auto">
    <div class="input max-md:hidden rounded-full">
        <label class="sr-only" for="searchInput">Full Name</label>
        <input type="search" class="grow" placeholder="Rechercher" wire:model="q" id="searchInput"/>
        <select class="select join-item w-36" wire:model="filter" aria-label="select">
            <option value="en_salle" }>
                En salle
            </option>
            <option value="tmdb">
                TheMovieDatabase
            </option>
        </select>
    </div>
</form>
