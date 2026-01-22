<?php

namespace App\Filament\Resources\DownloadRequestScheduleResource\Pages;

use App\Filament\Resources\DownloadRequestScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDownloadRequestSchedules extends ManageRecords
{
    protected static string $resource = DownloadRequestScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
