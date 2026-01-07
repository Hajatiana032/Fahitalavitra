<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MovieResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMovie extends CreateRecord
{
    protected static string $resource = MovieResource::class;
    protected static ?string $breadcrumb = "Nouveau";
    protected static ?string $title = 'Ajouter un film';
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResourceUrl('index');
    }
}
