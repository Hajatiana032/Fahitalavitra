<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    protected static ?string $title = 'Mon profil';

    public function getHeading(): string
    {
        return auth()->user()->getFilamentName();
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('last_name')
                ->label('Nom')
                ->required()
                ->maxLength(255),
            TextInput::make('first_name')
                ->label('Prénom')
                ->required()
                ->maxLength(255),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
        ]);
    }
}
