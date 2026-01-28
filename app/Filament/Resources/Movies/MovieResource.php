<?php

namespace App\Filament\Resources\Movies;

use App\Filament\Resources\Movies\Pages\ListMovies;
use App\Filament\Resources\Movies\Pages\MovieInfo;
use App\Filament\Resources\Movies\Pages\TmdbList;
use App\Filament\Resources\Movies\Schemas\MovieForm;
use App\Filament\Resources\Movies\Tables\MoviesTable;
use App\Models\Movie;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTv;

    protected static ?string $recordTitleAttribute = 'Film';

    protected static ?string $breadcrumb = "Films";
    protected static ?string $navigationLabel = "Films";

    protected static ?string $slug = "films";
    protected array $extraBodyAttributes = ['data-theme' => 'spotify'];

    public static function form(Schema $schema): Schema
    {
        return MovieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MoviesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMovies::route(''),
            'tmdbList' => TmdbList::route('/films-sur-tmdb'),
            'movieInfo' => MovieInfo::route('/films-sur-tmdb/{record}'),
        ];
    }
}
