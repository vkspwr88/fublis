<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\AffiliateService;
use App\Services\AffListService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use ZipArchive;

class HomeController extends Controller
{
    public function index(Request $request)
	{
		if(isArchitect()){
			return to_route('architect.pitch-story.publications.index');
		}
		if(isJournalist()){
			return to_route('journalist.media-kit.index');
		}
		if(isAdmin()){
			return to_route('filament.backend.pages.dashboard');
		}
		// dd($request->all());
		if($request->ref){
			AffListService::setSession($request);
		}
		return view('users.pages.home');
	}

	public function aman()
	{
		try{
			$images = Image::query()
				->where('image_type', 'photographs')
				->where('imaggable_id', '9e9126ce-7a36-4a5b-b5fd-a17454bf8d8e')
				->get();

			$totalSize = 0;
			foreach($images as $image) {
				echo Storage::url($image->image_path);
				echo ' - ';
				echo Storage::size($image->image_path) / (1024 * 1024) . ' MB';
				echo '<hr>';
				$totalSize += (int)Storage::size($image->image_path);
			}
			echo ($totalSize / (1024 * 1024)) . ' MB';

			$imagesPath = $images->pluck('image_path');

			$zip = new ZipArchive;
			$zipFileName = ucfirst(str()->camel('AMAN SAINI')) . '-' . 'photos' . '.zip';

			if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === true) {
				$filesToZip = $imagesPath;
				/* info('open', [
					'imagesPath' => $imagesPath,
				]); */
				//dd(public_path($zipFileName), $filesToZip);
				foreach ($filesToZip as $tempFile) {
					// $tempFile = Storage::path($tempFile);
					$zip->addFile(
						Storage::path($tempFile),
						basename($tempFile)
					);
					//dd($file, basename($file));
					/* info('foreach', [
						'file' => basename($file),
					]); */
				}

				$zip->close();

				/* info('debug', [
					'zip' => $zip,
					'zipFileName' => $zipFileName,
					'public_path' => public_path($zipFileName),
				]); */

				return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
				// return response()->download(public_path($zipFileName));
			} else {
				throw ValidationException::withMessages(['Failed to create the zip file.']);
			}
		}
		catch(Exception $exp){
			ErrorLogController::logError(
				'zipFilesDownload', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// abort(500);
			echo $exp->getMessage();
			echo '<hr>';
		}

		phpinfo();
	}
}
