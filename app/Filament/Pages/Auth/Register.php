<?php

namespace App\Filament\Pages\Auth;


use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()->components([
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nom'),
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Prénom'),
            ]),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
        ]);
    }
}
