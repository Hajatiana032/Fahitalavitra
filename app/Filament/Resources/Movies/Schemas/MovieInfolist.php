<?php

namespace App\Filament\Resources\Movies\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MovieInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 2,
                ])
                    ->schema([
                        Section::make([
                            ImageEntry::make('image')->hiddenLabel()
                                ->disk('public')
                                ->imageSize('50%')->alignCenter(),
                        ]),
                        Section::make([
                            TextEntry::make('synopsis')->html()
                                ->label('Synopsis'),
                            Grid::make()->schema([
                                TextEntry::make('created_at')
                                    ->label('Date de création')
                                    ->dateTime('d-M-Y'),
                                TextEntry::make('updated_at')
                                    ->label('Date de modification')
                                    ->dateTime('d-M-Y'),
                            ]),
                        ]),
                    ])->columnSpanFull(),
            ]);
    }

    protected function getHeading(): string
    {
        return 'Modification';
    }
}
