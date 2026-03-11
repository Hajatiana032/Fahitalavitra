<?php

namespace App\Filament\Resources\Projections\Pages;

use App\Filament\Resources\Projections\ProjectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageProjections extends ManageRecords
{
    protected static string $resource = ProjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
