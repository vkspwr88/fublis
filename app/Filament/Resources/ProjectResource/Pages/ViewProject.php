<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Http\Controllers\Admin\ProjectController;
use App\Models\Image;
use App\Models\Project;
use App\Services\DownloadService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ActionGroup::make([
				Actions\Action::make('download0')
					->label('Download Fact File')
					->action(
						function (Project $project, DownloadService $downloadService) {
							return $downloadService->downloadFactFile($project->mediaKit[0], 'project');
						}
					),
				Actions\Action::make('download1')
					->label('Download Description')
					->hidden(fn(Project $project) => !$project->project_doc_path)
					->action(
						function (Project $project, DownloadService $downloadService) {
							$mediaKit = $project->mediaKit[0];
							return $downloadService->singleFileDownload($mediaKit->slug, $project->project_doc_path, 'Description');
						}
					),
				Actions\Action::make('download2')
					->label('Download Photographs')
					->hidden(fn(Project $project) => !($project->photographs && $project->photographs->where('image_type', 'photographs')->count() > 0))
					->action(
						function (Project $project/* , DownloadService $downloadService */) {
							$mediaKit = $project->mediaKit[0];
							$images = Image::query()
								->select('image_path')
								->where('image_type', 'photographs')
								->where('imaggable_id', $project->id)
								->limit(9)
								->get();

							$imagesPath = $images->pluck('image_path');

							$zip = new ZipArchive;
							$zipFileName = ucfirst(str()->camel($mediaKit->slug)) . '-' . 'photographs' . '.zip';

							if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
								$filesToZip = $imagesPath;
								foreach ($filesToZip as $tempFile) {
									$zip->addFile(
										Storage::path($tempFile),
										basename($tempFile)
									);
								}

								$zip->close();

								return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
							}
							// return $downloadService->zipFilesDownload($mediaKit, 'photographs', 'Photographs');
						}
					),
				Actions\Action::make('download3')
					->label('Download Diagrams')
					->hidden(fn(Project $project) => !($project->photographs && $project->photographs->where('image_type', 'drawings')->count() > 0))
					->action(
						function (Project $project, DownloadService $downloadService) {
							$mediaKit = $project->mediaKit[0];
							return $downloadService->zipFilesDownload($mediaKit, 'drawings', 'Drawings');
						}
					),
			]),
			Actions\EditAction::make(),
        ];
    }

	protected function mutateFormDataBeforeFill(array $data): array
    {
		$data = ProjectController::mutateFormDataBeforeFill($data);
		// dd($data);
        return $data;
    }
}
