<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('movie.image')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('movie.title')
                    ->listWithLineBreaks()
                    ->label('Films')
                    ->searchable(),
                TextColumn::make('theater')
                    ->label('Salle')
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Date')
                    ->date('D-d-M-Y'),
                TextColumn::make('time')
                    ->label('Heure')
                    ->time(),
                TextColumn::make('stocks')
                    ->badge()
                    ->color(fn($state): string => match (true) {
                        $state >= 34 => 'success',
                        $state >= 17 => 'warning',
                        default => 'danger'
                    }),
                TextColumn::make('price')->label('prix')->money('MGA'),
            ])
            ->recordActions([
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped();
    }
}
