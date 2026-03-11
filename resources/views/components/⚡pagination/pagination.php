<?php

use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component {
    #[Url]
    public int $page = 1;
    public int $totalPages = 1;
    public string $route;
    public array $params = [];
};
