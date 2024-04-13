<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArchitects extends ListRecords
{
    protected static string $resource = ArchitectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
								->label('New Architect'),
        ];
    }
}
