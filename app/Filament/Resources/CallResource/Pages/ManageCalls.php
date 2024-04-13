<?php

namespace App\Filament\Resources\CallResource\Pages;

use App\Filament\Resources\CallResource;
use App\Http\Controllers\Admin\CallController;
use App\Http\Controllers\Users\LocationController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageCalls extends ManageRecords
{
    protected static string $resource = CallResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->label('New Call')
				->using(function (array $data, string $model): Model {
					return CallController::create($data, $model);
				})
				->successNotification(
					Notification::make()
						->success()
						->title('Call Added')
						->body('New call has been created successfully.'),
				),
        ];
    }
}
