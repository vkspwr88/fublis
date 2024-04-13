<?php

namespace App\Filament\Resources\JournalistResource\Pages;

use App\Filament\Resources\JournalistResource;
use App\Http\Controllers\Admin\JournalistController;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJournalist extends ViewRecord
{
    protected static string $resource = JournalistResource::class;

	protected static ?string $title = 'View Journalist';

	protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
								->label('Edit Journalist'),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		$data = JournalistController::mutateFormDataBeforeFill($data);
		// dd($data);
        return $data;
    }
}
