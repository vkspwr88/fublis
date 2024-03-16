<?php

namespace App\Filament\Resources\JournalistResource\Pages;

use App\Filament\Resources\JournalistResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJournalist extends ViewRecord
{
    protected static string $resource = JournalistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
