<?php

namespace App\Filament\Resources\TopPublicationResource\Pages;

use App\Filament\Resources\TopPublicationResource;
use App\Http\Controllers\Users\LocationController;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopPublication extends EditRecord
{
    protected static string $resource = TopPublicationResource::class;

	protected function mutateFormDataBeforeFill(array $data): array
	{
		// dd($data);
		$location = LocationController::findById($data['location_id']);
		$data['location_id'] = strtolower($location->name);
		return $data;
	}

	protected function mutateFormDataBeforeSave(array $data): array
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
