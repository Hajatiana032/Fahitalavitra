<?php

namespace App\Filament\Resources\Projections;

use App\Filament\Resources\Projections\Pages\ManageProjections;
use App\Filament\Resources\Projections\Pages\Sales;
use App\Models\Projection;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProjectionResource extends Resource
{
    protected static ?string $model = Projection::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $recordTitleAttribute = 'Projections';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('tickets');
    }


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('movie_id')
                    ->relationship('movie', 'title')
                    ->label('Films')
                    ->required(),
                Select::make('room')
                    ->label('Salle')
                    ->options([
                        'Salle 1' => 'Salle 1',
                        'Salle 2' => 'Salle 2',
                        'Salle 3' => 'Salle 3',
                    ])
                    ->required(),
                DateTimePicker::make('start_at')
                    ->label('Date et heure')
                    ->required(),
                TextInput::make('price')
                    ->label('Prix')
                    ->default(15000)
                    ->required()
                    ->prefix('Ariary'),
                TextInput::make('max_tickets')
                    ->label('Nombre de tickets')
                    ->default(50)
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('movie.title')
                    ->label('Movie'),
                TextEntry::make('room'),
                TextEntry::make('start_at')
                    ->label('Date et heure')
                    ->dateTime(),
                TextEntry::make('price')
                    ->label('Prix')
                    ->money(),
                TextEntry::make('max_tickets')
                    ->label('Nombre de tickets')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Projection')
            ->columns([
                TextColumn::make('movie.title')
                    ->label('Films')
                    ->searchable(),
                TextColumn::make('room')
                    ->label('Salle')
                    ->searchable(),
                TextColumn::make('start_at')
                    ->label('Date et heure')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Prix')
                    ->money('MGA', locale: 'fr_MG')
                    ->sortable(),
                TextColumn::make('max_tickets')
                    ->label('Total des billets')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('remainingTickets')
                    ->label('Billets restants')
                    ->state(
                        fn(Projection $record
                        ): int => ($record->max_tickets - $record->tickets_count),
                    )
                    ->badge()
                    ->color(
                        function (Projection $record): string {
                            return match (true) {
                                ($record->max_tickets - $record->tickets_count) <= 15 => 'danger',
                                ($record->max_tickets - $record->tickets_count) <= 30 => 'warning',
                                default => 'success'
                            };
                        }
                    ),
            ])
            ->filters([
                //
            ])
            ->recordActions(
                ActionGroup::make([
                    ViewAction::make(),
                    Action::make('sale')->label('Ventes')->url(
                        fn(Model $record): string => route('filament.admin.resources.projections.sales', [
                            'record' => $record->slug,
                        ])
                    )->icon(Heroicon::Banknotes)->color('info'),
                    EditAction::make(),
                    DeleteAction::make(),
                ])->label('Actions')->button(),
            )
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageProjections::route('/'),
            'sales' => Sales::route('/ventes/{record}'),
        ];
    }

    public static function getRecordRouteKeyName(): string
    {
        return 'slug';
    }
}
