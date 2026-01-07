<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Icon;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class MovieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->required(),
                TextInput::make('slug')->afterContent(Icon::make(Heroicon::LockClosed))->required()->readOnly(),
                FileUpload::make('image')
                    ->label('Couverture')
                    ->disk('public')
                    ->directory('uploads/images')
                    ->imageEditor()->image()
                    ->columnSpanFull(),
                RichEditor::make('synopsis')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
