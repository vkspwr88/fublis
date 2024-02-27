<?php

namespace App\Filament\Resources\TopPublicationListResource\Pages;

use App\Filament\Resources\TopPublicationListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopPublicationLists extends ListRecords
{
    protected static string $resource = TopPublicationListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
