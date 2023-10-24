<?php

namespace App\Filament\Resources\TeamSizeResource\Pages;

use App\Filament\Resources\TeamSizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTeamSizes extends ManageRecords
{
    protected static string $resource = TeamSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
