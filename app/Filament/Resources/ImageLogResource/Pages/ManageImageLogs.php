<?php

namespace App\Filament\Resources\ImageLogResource\Pages;

use App\Filament\Resources\ImageLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageImageLogs extends ManageRecords
{
    protected static string $resource = ImageLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
