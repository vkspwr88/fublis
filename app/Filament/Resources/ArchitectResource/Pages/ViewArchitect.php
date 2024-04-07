<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Resources\ArchitectResource;
use App\Http\Controllers\Admin\ArchitectController;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewArchitect extends ViewRecord
{
    protected static string $resource = ArchitectResource::class;

	protected static ?string $title = 'View Architect';

	protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		$data = ArchitectController::mutateFormDataBeforeFill($data);
		// dd($data);
        return $data;
    }
}
