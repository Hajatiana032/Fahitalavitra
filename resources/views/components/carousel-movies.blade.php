<div id="popular" data-carousel='{ "loadingClasses": "opacity-0","isInfiniteLoop": true,"slidesQty": { "xs": 1,
    "sm":3,
    "md":3,"lg": 4 } }'
     class="relative w-full">
    <div class="carousel rounded-none h-100">
        <div class="carousel-body h-100 opacity-0">
            @foreach($movies as $movie)
                <div class="carousel-slide">
                    <div class="flex size-full justify-center">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                             alt="{{ $movie['title'] }}"/>
                        <div class="absolute flex justify-end">
                            <button class="btn btn-secondary">Plus d'infos</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <button type="button"
            class="carousel-prev start-5 max-sm:start-3 bg-primary carousel-disabled:opacity-50
                                    size-9.5 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
        <i class="fa fa-angle-left"></i>
        <span class="sr-only">Previous</span>
    </button>
    <!-- Next Slide -->
    <button type="button"
            class="carousel-next end-5 max-sm:end-3 bg-primary carousel-disabled:opacity-50 size-9.5 flex
                                    items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
        <i class="fa fa-angle-right"></i>
        <span class="sr-only">Next</span>
    </button>
</div>
