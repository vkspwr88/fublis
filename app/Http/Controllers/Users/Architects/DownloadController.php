<?php

namespace App\Http\Controllers\Users\Architects;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\DownloadRequest;
use App\Models\MediaKit;
use App\Services\DownloadService;
use App\Services\NotificationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
{
	private DownloadService $downloadService;

	public function __construct(
		DownloadService $downloadService,
	)
	{
		$this->downloadService = $downloadService;
	}

    public function index(MediaKit $mediaKit, Request $request)
	{
		return $this->downloadService->singleFileDownload($request->file);
	}

	public function bulk(MediaKit $mediaKit, Request $request)
	{
		return $this->downloadService->zipFilesDownload($mediaKit, $request->file);
	}

	public static function approveRequest(DownloadRequest $downloadRequest)
	{
		//dd($downloadRequest);
		try{
			DB::beginTransaction();

			$downloadRequest->update([
				'request_status' => RequestStatusEnum::APPROVED,
			]);

			$downloadRequest->load([
				'requestedJournalist',
				'mediaKit' => [
					'story',
					'architect' => [
						'user'
					]
				]
			]);

			NotificationService::sendApprovedDownloadRequestNotification([
				'architect_slug' => $downloadRequest->mediaKit->architect->slug,
				'architect_name' => $downloadRequest->mediaKit->architect->user->name,
				'media_kit_slug' => $downloadRequest->mediaKit->slug,
				'media_kit_title' => $downloadRequest->mediaKit->story->title,
				'journalist_user_id' => $downloadRequest->requestedJournalist->id,
				'poly' => $downloadRequest,
			]);

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public static function declineRequest(DownloadRequest $downloadRequest)
	{
		try{
			DB::beginTransaction();

			$downloadRequest->update([
				'request_status' => RequestStatusEnum::DECLINED,
			]);

			$downloadRequest->load([
				'requestedJournalist',
				'mediaKit' => [
					'story',
					'architect' => [
						'user'
					]
				]
			]);

			NotificationService::sendDeclinedDownloadRequestNotification([
				'architect_slug' => $downloadRequest->mediaKit->architect->slug,
				'architect_name' => $downloadRequest->mediaKit->architect->user->name,
				'media_kit_slug' => $downloadRequest->mediaKit->slug,
				'media_kit_title' => $downloadRequest->mediaKit->story->title,
				'journalist_user_id' => $downloadRequest->requestedJournalist->id,
				'poly' => $downloadRequest,
			]);

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			dd($exp->getMessage());
			return false;
		}
		return true;
	}
}
