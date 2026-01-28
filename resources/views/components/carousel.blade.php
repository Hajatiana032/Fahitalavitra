<div id="multi-slide"
    data-carousel='{ "loadingClasses": "opacity-0","isInfiniteLoop": true,"slidesQty": { "xs": 1,"sm":3,"md": 4,
     "lg": 5 } }'
    class="relative w-full">
    <div class="carousel h-100">
        <div class="carousel-body  h-100 opacity-0">
            @foreach ($movies as $movie)
                <div class="carousel-slide">
                    <div class="flex size-full justify-center">
                        <a href="#" class="waves">
                            <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}"
                                alt="{{ $movie['title'] }}" class="w-full h-100" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Previous Slide -->
    <button type="button"
        class="carousel-prev start-5 max-sm:start-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
        <span class="fa fa-arrow-left"></span>
        <span class="sr-only">Previous</span>
    </button>
    <!-- Next Slide -->
    <button type="button"
        class="carousel-next end-5 max-sm:end-3 carousel-disabled:opacity-50 size-9.5 bg-base-100 flex items-center justify-center rounded-full shadow-base-300/20 shadow-sm">
        <span class="fa fa-arrow-right"></span>
        <span class="sr-only">Next</span>
    </button>
</div>
