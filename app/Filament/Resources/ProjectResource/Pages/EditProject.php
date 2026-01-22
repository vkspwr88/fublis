<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Http\Controllers\Admin\ProjectController;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		// dd($data);
		$data = ProjectController::mutateFormDataBeforeFill($data);
        return $data;
    }
}
