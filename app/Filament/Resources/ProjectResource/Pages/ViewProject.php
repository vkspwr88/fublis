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
					->url(fn (Project $project): string => route('download.zip', [
						'mediaKit' => $project->mediaKit[0]->id,
						'file' => 'photographs',
						'type' => 'Photographs',
					])),
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
