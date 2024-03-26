<?php

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ManagePublications extends ManageRecords
{
    protected static string $resource = PublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->using(function (array $data, string $model): Model {
					$country = LocationController::getCountryById($data['country']);
					LocationController::createLocation([
						'name' => $country->name,
						'city_flag' => 0,
						'state_flag' => 0,
						'country_flag' => 1,
					]);
					$state = LocationController::getStateById($data['state']);
					LocationController::createLocation([
						'name' => $state->name,
						'city_flag' => 0,
						'state_flag' => 1,
						'country_flag' => 0,
					]);
					$city = LocationController::getCityById($data['location_id']);
					$location = LocationController::createLocation([
						'name' => $city->name,
						'city_flag' => 1,
						'state_flag' => 0,
						'country_flag' => 0,
					]);

					$data['location_id'] = $location->id;
					$data['slug'] = PublicationController::generateSlug($data['name']);
					$data['instagram'] = $data['instagram'] ? 'http://' . trimWebsiteUrl($data['instagram']) : null;
					$data['website'] = $data['website'] ? 'http://' . trimWebsiteUrl($data['website']) : null;
					Arr::forget($data, ['country', 'state']);
					// dd($data, $model);
					return $model::create($data);
				})
				->successNotification(
					Notification::make()
						->success()
						->title('Publication Added')
						->body('New publication has been created successfully.'),
				),
        ];
    }
}
