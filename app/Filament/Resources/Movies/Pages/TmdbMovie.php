<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Resources\Pages\Page;

class TmdbMovie extends Page
{
    protected static string $resource = MovieResource::class;
    protected static ?string $breadcrumb = "Films sur The Movie Database";
    protected static ?string $title = 'Importer depuis The Movie Database';
    public string $message = 'Hello from Livewire component MoviesTmdb';
    public array $moviesList = [];
    protected ?string $heading = 'Importer depuis The Movie Database';
    protected string $view = 'filament.resources.movies.pages.tmdb-movie';
}
