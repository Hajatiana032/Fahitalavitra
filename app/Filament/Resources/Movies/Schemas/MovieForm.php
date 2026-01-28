<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MovieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                TextInput::make('slug')
                    ->label('')
                    ->required(),
                TextInput::make('tmdb_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
