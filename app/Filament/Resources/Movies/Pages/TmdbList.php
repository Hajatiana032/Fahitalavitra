<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;

class TmdbList extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static string $resource = MovieResource::class;
    protected static ?string $title = "Les films sur TMDB";
    
    protected array $extraBodyAttributes = [
        'data-theme' => 'spotify',
    ];
    protected string $view = 'filament.resources.movies.pages.tmdb-list';
}
