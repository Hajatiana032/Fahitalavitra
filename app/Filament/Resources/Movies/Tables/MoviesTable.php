<?php

namespace App\Filament\Resources\Movies\Tables;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MoviesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->circular()
                ,
                TextColumn::make('title')->label('Titre')
                    ->searchable(),
                TextColumn::make('synopsis')->label('synopsis')->formatStateUsing(fn($state) => strip_tags($state))
                    ->limit(50)->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->emptyStateHeading("Vide")
            ->emptyStateActions([
                Action::make('create')->label('Ajouter un film')->icon('heroicon-o-plus')->url(
                    MovieResource::getUrl('create')
                ),
                Action::make('tmdb')->label('Importer depuis TMDB')
                    ->url(MovieResource::getUrl('tmdb'))
                    ->icon('heroicon-o-arrow-down'),
            ]);
    }
}
