<?php

namespace App\Filament\Resources\JournalistResource\Pages;

use App\Filament\Resources\JournalistResource;
use App\Http\Controllers\Admin\JournalistController;
use App\Models\Journalist;
use App\Services\ImageService;
use App\Services\JournalistService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJournalist extends ViewRecord
{
    protected static string $resource = JournalistResource::class;

	protected static ?string $title = 'View Journalist';

	protected function getHeaderActions(): array
    {
        return [
			Actions\Action::make('remove')
				->label('Remove Profile Pic')
				->action(
					function (Journalist $architect, ImageService $imageService) {
						// dd($architect);
						return $imageService->removeProfileImage($architect);
					}
				),
            Actions\EditAction::make()
								->label('Edit Journalist'),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		$data = JournalistController::mutateFormDataBeforeFill($data);
		// dd($data);
		$data['image_path'] = JournalistService::findById($data['id'])?->profileImage;
        return $data;
    }
}
