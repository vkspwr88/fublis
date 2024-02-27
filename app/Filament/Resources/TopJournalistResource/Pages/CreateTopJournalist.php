<?php

namespace App\Filament\Resources\TopJournalistResource\Pages;

use App\Filament\Resources\TopJournalistResource;
use App\Http\Controllers\Users\LocationController;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTopJournalist extends CreateRecord
{
    protected static string $resource = TopJournalistResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
		// dd($data);
		$location = LocationController::createLocation([
			'name' => $data['location_id'],
			'city_flag' => 0,
			'state_flag' => 0,
			'country_flag' => 1,
		]);
		$data['location_id'] = $location->id;
        return $data;
    }
}
