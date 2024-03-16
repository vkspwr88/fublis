<?php

namespace App\Filament\Resources\BuildingTypologyResource\Pages;

use App\Filament\Resources\BuildingTypologyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBuildingTypologies extends ManageRecords
{
    protected static string $resource = BuildingTypologyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
