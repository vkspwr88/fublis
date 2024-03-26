<?php

namespace App\Filament\Resources\PitchResource\Pages;

use App\Filament\Resources\PitchResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePitches extends ManageRecords
{
    protected static string $resource = PitchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->label('New Pitch'),
        ];
    }
}
