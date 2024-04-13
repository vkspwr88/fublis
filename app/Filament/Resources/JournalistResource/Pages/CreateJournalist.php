<?php

namespace App\Filament\Resources\JournalistResource\Pages;

use App\Filament\Resources\JournalistResource;
use App\Http\Controllers\Admin\JournalistController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateJournalist extends CreateRecord
{
    protected static string $resource = JournalistResource::class;

	protected static ?string $title = 'Create Journalist';

	protected function handleRecordCreation(array $data): Model
	{
		// return static::getModel()::create($data);
		return JournalistController::create($data, static::getModel());
	}

	protected function getSavedNotification(): ?Notification
	{
		return Notification::make()
			->success()
			->title('Journalist Added')
			->body('New journalist has been created successfully.');
	}
}
