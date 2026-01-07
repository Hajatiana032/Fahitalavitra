<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMovie extends EditRecord
{
    protected static string $resource = MovieResource::class;

    public function getTitle(): string
    {
        return $this->record->title;
    }

    public function getBreadcrumbs(): array
    {
        return ['Films', 'Modification', $this->record->title];
    }

    public function getHeading(): string
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResourceUrl('index');
    }
}
