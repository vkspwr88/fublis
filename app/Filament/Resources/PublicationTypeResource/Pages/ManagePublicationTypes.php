<?php

namespace App\Filament\Resources\PublicationTypeResource\Pages;

use App\Filament\Resources\PublicationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePublicationTypes extends ManageRecords
{
    protected static string $resource = PublicationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
