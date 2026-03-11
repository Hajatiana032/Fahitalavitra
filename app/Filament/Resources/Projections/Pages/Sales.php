<?php

namespace App\Filament\Resources\Projections\Pages;

use App\Filament\Resources\Projections\ProjectionResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class Sales extends Page
{
    use InteractsWithRecord;

    protected static string $resource = ProjectionResource::class;
    protected static ?string $title = 'Ventes';
    protected string $view = 'filament.resources.projections.pages.sales';

    public function getBreadcrumbs(): array
    {
        return ['Projection', 'Ventes', $this->record->movie->title];
    }

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function getHeading(): string
    {
        return __($this->record->movie->title);
    }
}
