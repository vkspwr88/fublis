<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewArchitect extends ViewRecord
{
    protected static string $resource = ArchitectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
