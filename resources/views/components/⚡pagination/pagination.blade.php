  <div x-data x-on:scroll-to-top.window="window.scrollTo({ top: 0, behavior: 'smooth' })">
      @if ($totalPages > 1)
          <nav class="flex items-center gap-x-1 mt-5">
              <button type="button" class="btn btn-soft" wire:click="previousPage" @disabled($page === 1)>Previous
              </button>
              <div class="flex items-center gap-x-1">
                  @for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++)
                      <button type="button" class="btn aria-[current='page']:text-bg-soft-primary"
                          @if ($page === $i) aria-current="page" @endif
                          wire:click="goToPage({{ $i }})">
                          {{ $i }}
                      </button>
                  @endfor
              </div>
              <button type="button" class="btn btn-soft" wire:click="nextPage" @disabled($page === $totalPages)>Next
              </button>
          </nav>
      @endif
  </div>
