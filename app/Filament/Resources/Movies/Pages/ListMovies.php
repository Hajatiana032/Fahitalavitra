<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;

    protected static ?string $title = 'Films';
    protected array $extraBodyAttributes = [
        'data-theme' => 'spotify',
    ];

    protected function getHeaderActions(): array
    {
        return [
            Action::make('tmdbList')
                ->label('Importer depuis TMDB')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn(): string => MovieResource::getUrl('tmdbList')),
        ];
    }
}
