<?php

namespace App\Filament\Resources\InterviewResource\Pages;

use App\Filament\Resources\InterviewResource;
use App\Models\Interview;
use App\Services\DownloadService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInterview extends ViewRecord
{
    protected static string $resource = InterviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
			Actions\Action::make('download2')
				// ->icon('heroicon-m-arrow-down-tray')
				->label('Download Project Brief')
				->hidden(fn(Interview $interview) => $interview->projectBrief->count() == 0)
				->action(
					function (Interview $interview) {
						$downloadService = new DownloadService;
						return $downloadService->zipFilesDownload($interview, 'brief', 'ProjectBrief');
					}
				),
            Actions\EditAction::make(),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
	{
		$record = static::getRecord();
		// dd($record->interviewBrief);
		$data['projectBrief'] = $record->projectBrief->pluck('image_path');
		/* foreach ($record->images as $image) {
			$data['images'][] = $image->path;
		}

		$data['product_images'] = $data['images'] ?? null; */

		return $data;
	}
}
