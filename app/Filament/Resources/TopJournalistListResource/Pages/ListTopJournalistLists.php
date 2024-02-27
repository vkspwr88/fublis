<?php

namespace App\Filament\Resources\TopJournalistListResource\Pages;

use App\Filament\Resources\TopJournalistListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopJournalistLists extends ListRecords
{
    protected static string $resource = TopJournalistListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
