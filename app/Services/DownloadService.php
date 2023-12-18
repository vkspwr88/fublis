<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use ZipArchive;

class DownloadService
{
	public function singleFileDownload($file)
	{
		return Storage::download($file);
	}

	public function zipFilesDownload($model, $file)
	{
		try{
			if($file === 'images'){
				$model->story->load(['images' => fn ($query) => $query->where('image_type', $file)]);
				$imagesPath = $model->story->images->pluck('image_path');
			}
			elseif($file === 'photographs' || $file === 'drawings'){
				$model->story
						->load([
							'photographs' => fn ($query) => $query->where('image_type', $file)
						]);
				$imagesPath = $model->story->photographs->pluck('image_path');
			}
			else{
				return;
			}

			$zip = new ZipArchive;
			$zipFileName = str()->headline($model->slug) . '.zip';

			if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
				$filesToZip = $imagesPath;
				foreach ($filesToZip as $file) {
					$file = Storage::path($file);
					$zip->addFile($file, basename($file));
				}

				$zip->close();

				return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
			} else {
				throw ValidationException::withMessages(['Failed to create the zip file.']);
			}
		}
		catch(Exception $exp){
			dd($exp->getMessage());
		}
	}
}
