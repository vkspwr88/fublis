<?php

namespace App\Filament\Resources\TopJournalistListResource\Pages;

use App\Filament\Resources\TopJournalistListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopJournalistList extends EditRecord
{
    protected static string $resource = TopJournalistListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
