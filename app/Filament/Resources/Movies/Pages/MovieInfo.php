<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Resources\Pages\Page;

class MovieInfo extends Page
{
    protected static string $resource = MovieResource::class;
    protected static ?string $title = 'Informations';
    public int $record;
    protected string $view = 'filament.resources.movies.pages.movie-info';
    protected array $extraBodyAttributes = ['data-theme' => 'spotify'];
}
