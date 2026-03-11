<?php

use App\Models\Customer;
use App\Models\Ticket;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

new class extends Component implements HasActions, HasSchemas, HasTable {
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public Customer $customer;

    public function table(Table $table): Table
    {
        return $table
            ->query(Ticket::query()->where('customer_id', $this->customer->id))
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function (Ticket $record): string {
                        if ($record->customer->projection->start_at < today()->toDateString()) {
                            return 'Expiré';
                        }

                        if ($record->status === 'invalid') {
                            return 'Utilisé';
                        }

                        return 'Valide';
                    })
                    ->color(function (Ticket $record): string {
                        if ($record->customer->projection->start_at < today()->toDateString()) {
                            return 'warning';
                        }

                        if ($record->status === 'invalid') {
                            return 'danger';
                        }

                        return 'success';
                    })
                    ->size('25px')
                    ->searchable(),
                ToggleColumn::make('check')
                    ->label('Checker')
                    ->getStateUsing(fn(Ticket $record): bool => $record->status === 'invalid')
                    ->disabled(fn(Ticket $record): bool => $record->status === 'invalid' ||
                        $record->customer->projection->start_at < today()->toDateString())
                    ->updateStateUsing(function (Ticket $record): bool {
                        $record->status = 'invalid';
                        $record->save();

                        return true;
                    })
                    ->offColor('danger'),
            ]);
    }
};
