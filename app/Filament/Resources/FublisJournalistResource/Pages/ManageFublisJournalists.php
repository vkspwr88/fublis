<?php

namespace App\Filament\Resources\FublisJournalistResource\Pages;

use App\Filament\Resources\FublisJournalistResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFublisJournalists extends ManageRecords
{
    protected static string $resource = FublisJournalistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
