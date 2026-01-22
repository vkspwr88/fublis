<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use App\Http\Controllers\Admin\ArchitectController;
use App\Models\Architect;
use App\Services\ArchitectService;
use App\Services\ImageService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewArchitect extends ViewRecord
{
    protected static string $resource = ArchitectResource::class;

	protected static ?string $title = 'View Architect';

	protected function getHeaderActions(): array
    {
        return [
			Actions\Action::make('remove')
				->label('Remove Profile Pic')
				->action(
					function (Architect $architect, ImageService $imageService) {
						// dd($architect);
						return $imageService->removeProfileImage($architect);
					}
				),
            Actions\EditAction::make()
								->label('Edit Architect'),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		$data = ArchitectController::mutateFormDataBeforeFill($data);
		// dd($data, ArchitectService::findById($data['id'])->profileImage);
		$data['image_path'] = ArchitectService::findById($data['id'])?->profileImage;
        return $data;
    }
}
