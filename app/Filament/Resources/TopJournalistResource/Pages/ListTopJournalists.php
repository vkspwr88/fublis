<?php

namespace App\Filament\Resources\TopJournalistResource\Pages;

use App\Filament\Resources\TopJournalistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopJournalists extends ListRecords
{
    protected static string $resource = TopJournalistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
