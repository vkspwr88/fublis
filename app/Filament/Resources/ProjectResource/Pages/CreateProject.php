<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Http\Controllers\Admin\ProjectController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

	protected function handleRecordCreation(array $data): Model
	{
		// return static::getModel()::create($data);
		return ProjectController::create($data, static::getModel());
	}

	protected function getSavedNotification(): ?Notification
	{
		return Notification::make()
			->success()
			->title('Project Added')
			->body('New project has been created successfully.');
	}
}
