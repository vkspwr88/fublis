<?php

namespace App\Filament\Resources\InterviewResource\Pages;

use App\Filament\Resources\InterviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInterview extends ViewRecord
{
    protected static string $resource = InterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
	{
		$record = static::getRecord();
		// dd($record->projectBrief);
		$data['projectBrief'] = $record->projectBrief->pluck('image_path');
		/* foreach ($record->images as $image) {
			$data['images'][] = $image->path;
		}

		$data['product_images'] = $data['images'] ?? null; */

		return $data;
	}
}
