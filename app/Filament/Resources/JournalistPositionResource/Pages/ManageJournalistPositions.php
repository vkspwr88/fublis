<?php

namespace App\Filament\Resources\JournalistPositionResource\Pages;

use App\Filament\Resources\JournalistPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJournalistPositions extends ManageRecords
{
    protected static string $resource = JournalistPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
