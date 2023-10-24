<?php

namespace App\Filament\Resources\ArchitectPositionResource\Pages;

use App\Filament\Resources\ArchitectPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageArchitectPositions extends ManageRecords
{
    protected static string $resource = ArchitectPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
