<?php

namespace App\Services;

use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\MediaKitController;
use App\Mail\User\Architect\DownloadRequestMail;
use App\Models\DownloadRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use ZipArchive;

class DownloadService
{
	public static function sendDownloadRequest($mediaKit, $user)
	{
		$mediaKit->load(['architect.user', 'story']);

		$downloadRequest = DownloadRequest::firstOrCreate([
			'media_kit_id' => $mediaKit->id,
			'requested_by' => $user->id,
		]);
		$journalist = $user->journalist;
		$notificationService = new NotificationService;
		$notificationService->sendDownloadRequestNotification([
			'poly' => $downloadRequest,
			'architect_user_id' => $mediaKit->architect->user_id,
			'journalist_slug' => $journalist->slug,
			'journalist_name' => $user->name,
			'media_kit_id' => $mediaKit->id,
			'media_kit_slug' => $mediaKit->slug,
			'media_kit_title' => $mediaKit->story->title,
		]);

		if(EmailPreferenceService::isPreferenceSelected($mediaKit->architect->user, 'architect-instant-download-request-mail')){
			Mail::to($mediaKit->architect->user->email)
				->queue(new DownloadRequestMail(
					$mediaKit->architect->user->email,
					$mediaKit->architect->user->name,
					$mediaKit->story->title,
					formatDate(Carbon::now()),
					[
						'journalist' => $user->name,
						'publication' => $journalist->publications[0]->name,
						'requestTime' => Carbon::now()->format('H:i'),
						'requestDate' => Carbon::now()->format('jS F Y'),
						'subscribed' => isSubscribed($mediaKit->architect->user),
					],
				));
		}
	}

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
			ErrorLogController::logError(
				'singleFileDownload', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// dd($exp->getMessage())
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
			elseif($file === 'brief'){
				$imagesPath = $model->projectBrief->pluck('image_path');
			}
			else{
				return;
			}

			$zip = new ZipArchive;
			$zipFileName = ucfirst(str()->camel($model->slug)) . '-' . $type . '.zip';

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
			abort(500);
			// dd($exp->getMessage())
		}
	}

	public function downloadFactFile($mediaKit, $type)
	{
		$mediaKit = MediaKitController::loadModel($mediaKit, $type);
		$view = 'users.pages.journalists.media-kits.projects.pdf';
		if($type == 'press-release'){
			$view = 'users.pages.journalists.media-kits.press-releases.pdf';
		}
		elseif($type == 'article'){
			$view = 'users.pages.journalists.media-kits.articles.pdf';
		}
		$pdf = Pdf::loadView($view, ['mediaKit' => $mediaKit]);
		// return $pdf->download(
		// 	ucfirst(str()->camel($mediaKit->slug)) . '-' . 'factfile' . '.pdf'
		// );
		return response()->streamDownload(function () use ($pdf) {
			echo $pdf->stream();
		}, ucfirst(str()->camel($mediaKit->slug)) . '-' . 'factfile' . '.pdf');
	}
}
