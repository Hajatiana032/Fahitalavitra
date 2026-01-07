<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMovie extends ViewRecord
{
    protected static string $resource = MovieResource::class;

    public function getHeading(): string
    {
        return $this->record->title;
    }

    public function getTitle(): string
    {
        return $this->record->title;
    }

    public function getBreadcrumb(): string
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->icon('heroicon-o-trash'),
            EditAction::make()->icon('heroicon-o-pencil-square'),
        ];
    }
}
