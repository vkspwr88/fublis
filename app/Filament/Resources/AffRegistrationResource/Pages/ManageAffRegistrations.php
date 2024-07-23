<?php

namespace App\Filament\Resources\AffRegistrationResource\Pages;

use App\Filament\Resources\AffRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAffRegistrations extends ManageRecords
{
    protected static string $resource = AffRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
