<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\LocationController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ManageCompanies extends ManageRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->label('New Studio')
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
					$data['slug'] = CompanyController::generateSlug($data['name']);
					$data['website'] = $data['website'] ? 'http://' . trimWebsiteUrl($data['website']) : null;
					$media = MediaController::getRecordById($data['media_id']);

					Arr::forget($data, ['country', 'state', 'media_id']);
					// dd($data, $model);
					$result = $model::create($data);
					if($media){
						$newPath = 'images/companies/logos/' . uniqid() . '.' . $media->ext;
						Storage::copy($media->path, $newPath);
						ImageController::updateOrCreate($result->profileImage(), [
							'image_type' => 'logo',
							'image_path' => $newPath,
						]);
					}
					return $result;
				})
				->successNotification(
					Notification::make()
						->success()
						->title('Studio Added')
						->body('New studio has been created successfully.'),
				),
        ];
    }
}
