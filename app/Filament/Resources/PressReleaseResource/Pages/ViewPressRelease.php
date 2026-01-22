<?php

namespace App\Filament\Resources\PressReleaseResource\Pages;

use App\Filament\Resources\PressReleaseResource;
use App\Models\PressRelease;
use App\Services\DownloadService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPressRelease extends ViewRecord
{
    protected static string $resource = PressReleaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
			Actions\ActionGroup::make([
				Actions\Action::make('download0')
					->label('Download Fact File')
					->action(
						function (PressRelease $pressRelease, DownloadService $downloadService) {
							return $downloadService->downloadFactFile($pressRelease->mediaKit[0], 'press-release');
						}
					),
				Actions\Action::make('download1')
					->label('Download Description')
					->hidden(fn(PressRelease $pressRelease) => !$pressRelease->press_release_doc_path)
					->action(
						function (PressRelease $pressRelease, DownloadService $downloadService) {
							$mediaKit = $pressRelease->mediaKit[0];
							return $downloadService->singleFileDownload($mediaKit->slug, $pressRelease->press_release_doc_path, 'Description');
						}
					),
				/* Actions\Action::make('download2')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Full PressRelease')
					->hidden(fn(PressRelease $pressRelease) => !$pressRelease->pressRelease_doc_path)
					->action(
						function (PressRelease $pressRelease) {
							$mediaKit = $pressRelease->mediaKit[0];
							$downloadService = new DownloadService;
							return $downloadService->singleFileDownload($mediaKit->slug, $pressRelease->pressRelease_doc_path, 'FullPressRelease');
						}
					), */
				Actions\Action::make('download3')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Photographs')
					->hidden(fn(PressRelease $pressRelease) => $pressRelease->photographs->count() == 0)
					->action(
						function (PressRelease $pressRelease, DownloadService $downloadService) {
							$mediaKit = $pressRelease->mediaKit[0];
							return $downloadService->zipFilesDownload($mediaKit, 'photographs', 'Photographs');
						}
					),
			]),
            Actions\EditAction::make(),
        ];
    }
}
