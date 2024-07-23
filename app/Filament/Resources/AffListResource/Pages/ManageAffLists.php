<?php

namespace App\Filament\Resources\AffListResource\Pages;

use App\Filament\Resources\AffListResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAffLists extends ManageRecords
{
    protected static string $resource = AffListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
