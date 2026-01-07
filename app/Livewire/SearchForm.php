<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class SearchForm extends Component
{
    public string $q = '';
    public string $filter = 'en_salle';


    public function search(): void
    {
        $this->validate([
            'q' => 'required|min:3',
        ]);

//        $this->dispatch('send-query', q: $this->q, filter: $this->filter);
        $this->redirectRoute('search.index', ['q' => $this->q, 'filter' => $this->filter], navigate: true);
    }

    public function render(): View
    {
        return view('livewire.search-form');
    }
}
