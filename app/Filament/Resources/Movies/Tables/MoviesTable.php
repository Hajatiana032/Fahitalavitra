<?php

namespace App\Filament\Resources\Movies\Tables;

use App\Filament\Resources\Movies\MovieResource;
use App\Models\Movie;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MoviesTable
{
    protected array $extraBodyAttributes = ["data-theme" => "spotify"];
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title")->label("Titre")->searchable(),
                TextColumn::make("tmdb_id")
                    ->label("Identifiant sur TMDB")
                    ->numeric()
                    ->searchable(),
                TextColumn::make("created_at")
                    ->label("Ajouté le")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
                Action::make("info")
                    ->label("Infos")
                    ->icon(Heroicon::InformationCircle)
                    ->url(
                        fn($record) => MovieResource::getUrl("movieInfo", [
                            "record" => $record->tmdb_id,
                        ]),
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()->button()]),
            ]);
    }
}
