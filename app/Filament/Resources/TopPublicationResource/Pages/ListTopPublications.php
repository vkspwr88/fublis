<?php

namespace App\Filament\Resources\TopPublicationResource\Pages;

use App\Filament\Resources\TopPublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopPublications extends ListRecords
{
    protected static string $resource = TopPublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
