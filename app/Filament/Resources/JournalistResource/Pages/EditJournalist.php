<?php

namespace App\Filament\Resources\JournalistResource\Pages;

use App\Filament\Resources\JournalistResource;
use App\Http\Controllers\Admin\JournalistController;
use App\Models\Journalist;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditJournalist extends EditRecord
{
    protected static string $resource = JournalistResource::class;

	protected static ?string $title = 'Edit Journalist';

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
		$journalistPublications = Journalist::find($data['id'])->journalistPublications;
		$data['publication_id'] = $journalistPublications[0]->publication_id;
		$data['journalist_position_id'] = $journalistPublications[0]->journalist_position_id;
		// dd($data, $journalistPublications);
		$data = JournalistController::mutateFormDataBeforeFill($data);
		// dd($data);
        return $data;
    }

	// protected function mutateRel

	protected function handleRecordUpdate(Model $record, array $data): Model
	{
		return JournalistController::update($record, $data);
	}

	protected function getSavedNotification(): ?Notification
	{
		return Notification::make()
			->success()
			->title('Journalist updated')
			->body('The journalist has been saved successfully.');
	}
}
