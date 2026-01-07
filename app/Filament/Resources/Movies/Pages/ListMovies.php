<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Schema;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;
    protected static ?string $title = 'Films';
    protected static ?string $breadcrumb = 'Liste';

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            EmbeddedTable::make(),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Ajouter un film')
                ->icon('heroicon-o-plus')
                ->url(MovieResource::getUrl('create')),
            Action::make('tmdb')->label('Importer depuis TMDB')
                ->icon('heroicon-o-arrow-down')
                ->url(MovieResource::getUrl('tmdb')),
        ];
    }
}
