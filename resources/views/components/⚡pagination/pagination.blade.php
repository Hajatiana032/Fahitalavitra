<div>
    @if ($totalPages > 1)
        <nav class="flex items-center gap-x-1 mt-5">
            <a href="{{ route($route, array_merge($params,['page'=>$page - 1])) }}"
               type="button"
               class="btn btn-soft"
               @disabled($page === 1) wire:navigate>Précédent
            </a>
            <div class="flex items-center gap-x-1">
                @for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++)
                    <a href="{{ route($route, array_merge($params,['page' => $i])) }}"
                       type="button"
                       class="btn aria-[current='page']:text-bg-soft-primary"
                       @if ($page === $i) aria-current="page"
                       @endif
                       wire:navigate>
                        {{ $i }}
                    </a>
                @endfor
            </div>
            <a href="{{ route($route, array_merge($params,['page' => $page + 1])) }}"
               @disabled($page === $totalPages) class="btn btn-soft"
               wire:navigate>Suivant
            </a>
        </nav>
    @endif
</div>
