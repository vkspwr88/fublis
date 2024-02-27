<?php

namespace App\Filament\Resources\TopPublicationListResource\Pages;

use App\Filament\Resources\TopPublicationListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopPublicationList extends EditRecord
{
    protected static string $resource = TopPublicationListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
