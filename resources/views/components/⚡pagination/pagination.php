<?php

use App\Services\UrlApiService;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public int $page = 1;
    public int $totalPages = 1;

    public function previousPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
            $this->dispatch('page-changed', $this->page);
            $this->dispatch('scroll-to-top');
        }
    }

    #[On('search-updated')]
    public function onSearchUpdated(): void
    {
        $this->page = 1;
    }

    public function nextPage(): void
    {
        if ($this->page < $this->totalPages) {
            $this->page++;
            $this->dispatch('page-changed', $this->page);
            $this->dispatch('scroll-to-top');
        }
    }

    public function goToPage(int $page): void
    {
        if ($page >= 1 && $page <= $this->totalPages) {
            $this->page = $page;
            $this->dispatch('page-changed', $this->page);
            $this->dispatch('scroll-to-top');
        }
    }
};
