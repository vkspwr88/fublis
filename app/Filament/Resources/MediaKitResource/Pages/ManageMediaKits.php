<?php

namespace App\Filament\Resources\MediaKitResource\Pages;

use App\Filament\Resources\MediaKitResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMediaKits extends ManageRecords
{
    protected static string $resource = MediaKitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
