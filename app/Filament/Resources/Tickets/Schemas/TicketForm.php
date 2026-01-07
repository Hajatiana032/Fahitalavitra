<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('movie_id')
                    ->label('Film')
                    ->placeholder('Sélectionner un film')
                    ->relationship('movie', 'title')
                    ->required(),
                Select::make('theater')
                    ->placeholder('Sélectionner le numéro de salle')
                    ->options([
                        'Salle 1' => 'Salle 1',
                        'Salle 2' => 'Salle 2',
                        'Salle 3' => 'Salle 3',
                        'Salle 4' => 'Salle 4',
                    ])
                    ->required(),
                DatePicker::make('date')->label('Date')->required(),
                TimePicker::make('time')->label('Heure')->required(),
                TextInput::make('stock')->label('Stock')->integer()->default(50),
                TextInput::make('price')->label('Prix')->integer()->suffix('Ariary'),
            ]);
    }
}
