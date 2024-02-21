<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use ZipArchive;

class DownloadService
{
	public function singleFileDownload($slug, $file, $type)
	{
		try{
			/* $name = ucfirst(str()->camel($slug)) . '-' . $type;
			return Storage::download($file, $name); */
			$zip = new ZipArchive;
			$zipFileName = ucfirst(str()->camel($slug)) . '-' . $type . '.zip';
			if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
				$file = Storage::path($file);
				$zip->addFile($file, basename($file));
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

	public function zipFilesDownload($model, $file, $type)
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
			$zipFileName = ucfirst(str()->camel($model->slug)) . '-' . $type . '.zip';

			if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
				$filesToZip = $imagesPath;
				//dd(public_path($zipFileName), $filesToZip);
				foreach ($filesToZip as $file) {
					$file = Storage::path($file);
					$zip->addFile($file, basename($file));
					//dd($file, basename($file));
				}
				//dd($zip);
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
