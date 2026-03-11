<?php

use App\Models\Projection;
use Livewire\Component;

new class extends Component {
    use \Livewire\WithPagination;

    public string $search = '';
    public string $filterDate = '';
    public string $sortBy = 'start_at';
    public string $sortDirection = 'asc';

    public ?int $imageId = null;

    protected array $queryString = [
        'search' => ['except' => ''],
        'filterDate' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterDate()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }


    public function render()
    {
        $projections = Projection::with('movie')->orderBy('created_at', 'DESC')->paginate(10);

        return $this->view(['projections' => $projections, 'imageId' => $this->imageId]);
    }
};
