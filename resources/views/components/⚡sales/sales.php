<?php

use App\Models\Customer;
use App\Models\Sale;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

new class extends Component implements HasActions, HasSchemas, HasTable {
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public int $projectionId;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Customer::query()
                    ->with(['tickets', 'projection'])
                    ->withCount('tickets')
                    ->where('projection_id', $this->projectionId)
            )
            ->columns([
                TextColumn::make('last_name')->label('Nom')->searchable(),
                TextColumn::make('first_name')->label('Prénom')->searchable(),
                TextColumn::make('email')->label('Email')->searchable()->icon(Heroicon::OutlinedEnvelopeOpen),
                TextColumn::make('phone')->label('Téléphone')->searchable()->icon(Heroicon::OutlinedPhone),
                TextColumn::make('tickets_count')->label('Nombre de tickets'),
            ])->recordActions([
                Action::make('tickets')->label('Afficher les billets')->modalContent(
                    fn($record) => view(
                        'components.customer-tickets-modal',
                        ['customer' => $record]
                    )
                )->icon(Heroicon::OutlinedTicket)
                    ->button()
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalHeading(fn($record) => $record->last_name.' '.$record->first_name)
                    ->stickyModalHeader(),
                DeleteAction::make('delete')->label('Supprimer')->button(),
            ]);
    }
};
