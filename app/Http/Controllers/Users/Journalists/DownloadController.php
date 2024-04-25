<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ErrorLogController;
use App\Mail\User\Architect\DownloadRequestMail;
use App\Models\DownloadRequest;
use App\Models\MediaKit;
use App\Services\DownloadService;
use App\Services\NotificationService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DownloadController extends Controller
{
    private DownloadService $downloadService;
    private NotificationService $notificationService;

	public function __construct(
		DownloadService $downloadService,
		NotificationService $notificationService,
	)
	{
		$this->downloadService = $downloadService;
		$this->notificationService = $notificationService;
	}

    public function index(MediaKit $mediaKit, Request $request)
	{
		$this->notificationService->sendDownloadCountNotification([
			'media_kit_id' => $mediaKit->id,
			'media_kit_slug' => $mediaKit->slug,
			'media_kit_title' => $mediaKit->story->title,
			'journalist_id' => auth()->id(),
			'journalist_slug' => auth()->user()->journalist->slug,
			'journalist_name' => auth()->user()->name,
			'architect_user_id' => $mediaKit->architect->user_id,
		]);
		return $this->downloadService->singleFileDownload($mediaKit->slug, $request->file, $request->type);
	}

	public function request(MediaKit $mediaKit, Request $request)
	{
		try{
			DB::beginTransaction();
			$mediaKit->load(['architect.user', 'story']);
			$downloadRequest = DownloadRequest::firstOrCreate([
				'media_kit_id' => $mediaKit->id,
				'requested_by' => auth()->id(),
			]);
			$this->notificationService->sendDownloadRequestNotification([
				'poly' => $downloadRequest,
				'architect_user_id' => $mediaKit->architect->user_id,
				'journalist_slug' => auth()->user()->journalist->slug,
				'journalist_name' => auth()->user()->name,
				'media_kit_id' => $mediaKit->id,
				'media_kit_slug' => $mediaKit->slug,
				'media_kit_title' => $mediaKit->story->title,
			]);
			DB::commit();
			Mail::to($mediaKit->architect->user->email)->queue(new DownloadRequestMail($mediaKit->architect->user->email, $mediaKit->architect->user->name, $mediaKit->story->title, formatDate(Carbon::now())));
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'downloadRequest', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// dd($exp->getMessage());
		}

		/* $this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Download request sent to the architect.'
		]); */
		return to_route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug])->with([
			'type' => 'success',
			'message' => 'Download request sent to the architect.',
		]);
		//return $this->downloadService->singleFileDownload($request->file);
	}

	public function bulk(MediaKit $mediaKit, Request $request)
	{
		$this->notificationService->sendDownloadCountNotification([
			'media_kit_id' => $mediaKit->id,
			'media_kit_slug' => $mediaKit->slug,
			'media_kit_title' => $mediaKit->story->title,
			'journalist_id' => auth()->id(),
			'journalist_slug' => auth()->user()->journalist->slug,
			'journalist_name' => auth()->user()->name,
			'architect_user_id' => $mediaKit->architect->user_id,
		]);
		return $this->downloadService->zipFilesDownload($mediaKit, $request->file, $request->type);
	}
}
