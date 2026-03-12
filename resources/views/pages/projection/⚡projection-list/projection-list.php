<?php

use App\Models\Projection;
use Livewire\Component;

new class extends Component {
    use \Livewire\WithPagination;

    public ?string $movieTitle = null;
    public ?string $date = null;

    public function render()
    {
        $query = Projection::with('movie')->orderBy('created_at', 'DESC');

        // By title
        if ($this->movieTitle) {
            $query->whereHas('movie', function ($q) {
                $q->where('title', 'like', '%'.$this->movieTitle.'%');
            });
        }

        // By date
        if ($this->date) {
            $query->whereDate('start_at', $this->date);
        }

        return $this->view([
            'projections' => $query->paginate(10),
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['movieTitle', 'date']);
    }
};
