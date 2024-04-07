<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use App\Http\Controllers\Admin\ArchitectController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class CreateArchitect extends CreateRecord
{
    protected static string $resource = ArchitectResource::class;

	protected static ?string $title = 'Create Architect';

	protected function handleRecordCreation(array $data): Model
	{
		// return static::getModel()::create($data);
		return ArchitectController::create($data, static::getModel());
	}

	protected function getSavedNotification(): ?Notification
	{
		return Notification::make()
			->success()
			->title('Architect Added')
			->body('New architect has been created successfully.');
	}
}
