<?php

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Models\Publication;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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
					$media = MediaController::getRecordById($data['media_id']);
					Arr::forget($data, ['country', 'state', 'media_id']);
					// dd($data, $media);
					$result = $model::create($data);
					if($media){
						$newPath = 'images/publications/logos/' . uniqid() . '.' . $media->ext;
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
						->title('Publication Added')
						->body('New publication has been created successfully.'),
				),
        ];
    }

	public function getTabs(): array
	{
		return [
			'all' => Tab::make('All')
				->badge(Publication::query()->count()),
			'is_premium' => Tab::make('Premium')
				->badge(Publication::query()->where('is_premium', true)->count())
				->modifyQueryUsing(fn (Builder $query) => $query->where('is_premium', true)),
		];
	}
}
