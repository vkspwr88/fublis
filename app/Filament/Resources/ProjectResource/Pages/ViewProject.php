<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Http\Controllers\Admin\ProjectController;
use App\Models\Project;
use App\Services\DownloadService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ActionGroup::make([
				Actions\Action::make('download1')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Description')
					->hidden(fn(Project $project) => !$project->project_doc_path)
					->action(
						function (Project $project) {
							$mediaKit = $project->mediaKit[0];
							// dd($mediaKit, $project);
							$downloadService = new DownloadService;
							return $downloadService->singleFileDownload($mediaKit->slug, $project->project_doc_path, 'Description');
							// downloadService->singleFileDownload($mediaKit->slug, $request->file, $request->type);
							// downloadService->zipFilesDownload($mediaKit, $request->file, $request->type);
						}
					),
				Actions\Action::make('download2')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Photographs')
					->hidden(fn(Project $project) => !($project->photographs && $project->photographs->where('image_type', 'photographs')->count() > 0))
					->action(
						function (Project $project) {
							$mediaKit = $project->mediaKit[0];
							$downloadService = new DownloadService;
							return $downloadService->zipFilesDownload($mediaKit, 'photographs', 'Photographs');
						}
					),
				Actions\Action::make('download3')
					// ->icon('heroicon-m-arrow-down-tray')
					->label('Download Diagrams')
					->hidden(fn(Project $project) => !($project->photographs && $project->photographs->where('image_type', 'drawings')->count() > 0))
					->action(
						function (Project $project) {
							$mediaKit = $project->mediaKit[0];
							$downloadService = new DownloadService;
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
