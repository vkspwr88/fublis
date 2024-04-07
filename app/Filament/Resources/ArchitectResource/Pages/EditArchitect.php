<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use App\Http\Controllers\Admin\ArchitectController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditArchitect extends EditRecord
{
    protected static string $resource = ArchitectResource::class;

	protected static ?string $title = 'Edit Architect';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		$data = ArchitectController::mutateFormDataBeforeFill($data);
		// dd($data);
        return $data;
    }

	protected function handleRecordUpdate(Model $record, array $data): Model
	{
		return ArchitectController::update($record, $data);
	}

	protected function getSavedNotification(): ?Notification
	{
		return Notification::make()
			->success()
			->title('Architect updated')
			->body('The architect has been saved successfully.');
	}
}
