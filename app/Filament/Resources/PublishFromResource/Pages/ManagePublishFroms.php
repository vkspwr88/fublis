<?php

namespace App\Filament\Resources\PublishFromResource\Pages;

use App\Filament\Resources\PublishFromResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePublishFroms extends ManageRecords
{
    protected static string $resource = PublishFromResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
