<?php

namespace App\Filament\Resources\BuildingUseResource\Pages;

use App\Filament\Resources\BuildingUseResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBuildingUses extends ManageRecords
{
    protected static string $resource = BuildingUseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
