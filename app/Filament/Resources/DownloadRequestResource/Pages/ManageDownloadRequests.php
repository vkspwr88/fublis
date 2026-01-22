<?php

namespace App\Filament\Resources\DownloadRequestResource\Pages;

use App\Filament\Resources\DownloadRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDownloadRequests extends ManageRecords
{
    protected static string $resource = DownloadRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
