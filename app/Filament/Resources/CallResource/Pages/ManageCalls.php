<?php

namespace App\Filament\Resources\CallResource\Pages;

use App\Filament\Resources\CallResource;
use App\Http\Controllers\Users\Journalists\CallController;
use App\Http\Controllers\Users\LocationController;
use App\Livewire\Architects\Account\Notification;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageCalls extends ManageRecords
{
    protected static string $resource = CallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->using(function (array $data, string $model): Model {
					$location = LocationController::createLocation([
						'name' => $data['location_id'],
						'city_flag' => 0,
						'state_flag' => 0,
						'country_flag' => 1,
					]);
					$data['location_id'] = $location->id;
					$data['slug'] = CallController::generateSlug($data['title']);
					return $model::create($data);
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
