<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\LocationController;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;

class CreateArchitect extends CreateRecord
{
    protected static string $resource = ArchitectResource::class;

	protected function mutateFormDataBeforeCreate(array $data): array
    {
		// dd($data);
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
		$user = User::find($data['user_id']);
		$data['slug'] = ArchitectController::generateSlug($user->name);
		$data['linked_profile'] = $data['linked_profile'] ? 'http://' . trimWebsiteUrl($data['linked_profile']) : null;
		$data['published_article_link'] = $data['published_article_link'] ? 'http://' . trimWebsiteUrl($data['published_article_link']) : null;
		$data['publishing_platform_link'] = $data['publishing_platform_link'] ? 'http://' . trimWebsiteUrl($data['publishing_platform_link']) : null;
		Arr::forget($data, ['country', 'state']);
        return $data;
    }

	/* protected function beforeCreate(): void
	{
		dd($this->getRecord());
	} */
}
