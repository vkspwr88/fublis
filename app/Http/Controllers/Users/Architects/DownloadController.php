<?php

namespace App\Http\Controllers\Users\Architects;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ErrorLogController;
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
		return $this->downloadService->singleFileDownload($mediaKit->slug, $request->file, $request->type);
	}

	public function bulk(MediaKit $mediaKit, Request $request)
	{
		return $this->downloadService->zipFilesDownload($mediaKit, $request->file, $request->type);
	}

	public static function getDownloadRequests(array $ids){
		return DownloadRequest::whereIn('id', $ids)->get();
	}

	public static function approveRequest(DownloadRequest $downloadRequest)
	{
		//dd($downloadRequest);
		try{
			DB::beginTransaction();

			$downloadRequest->request_status = RequestStatusEnum::APPROVED;
			$downloadRequest->save();

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

			// Mail::to($downloadRequest->mediaKit->architect->user->email)->queue(new DownloadMediaKitMail($downloadRequest->mediaKit->architect->user->email, $downloadRequest->mediaKit->architect->user->name, $downloadRequest->mediaKit->story->title, formatDate(Carbon::now())));
			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'approveRequest', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public static function approveBulkRequest(array $ids)
	{
		//dd($downloadRequest);
		try{
			DB::beginTransaction();
			//dd($ids);
			$downloadRequests = DownloadController::getDownloadRequests($ids);

			foreach($downloadRequests as $downloadRequest){
				//dd($downloadRequest);
				$downloadRequest->request_status = RequestStatusEnum::APPROVED;
				$downloadRequest->save();

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
			}

			DB::commit();

			// Mail::to($downloadRequest->mediaKit->architect->user->email)->queue(new DownloadMediaKitMail($downloadRequest->mediaKit->architect->user->email, $downloadRequest->mediaKit->architect->user->name, $downloadRequest->mediaKit->story->title, formatDate(Carbon::now())));
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'approveBulkRequest', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public static function declineRequest(DownloadRequest $downloadRequest)
	{
		try{
			DB::beginTransaction();

			$downloadRequest->request_status = RequestStatusEnum::DECLINED;
			$downloadRequest->save();

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
			ErrorLogController::logError(
				'declineRequest', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public static function declineBulkRequest(array $ids)
	{
		try{
			DB::beginTransaction();

			$downloadRequests = DownloadController::getDownloadRequests($ids);

			foreach($downloadRequests as $downloadRequest){
				$downloadRequest->request_status = RequestStatusEnum::DECLINED;
				$downloadRequest->save();

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
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'declineBulkRequest', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			// dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public static function getAllowedDownloadRequest()
	{
		return isSubscribed() ? -1 : 5;
	}

	public static function getTotalRequest()
	{
		return auth()->user()->architect->load([
			'mediaKits' => [
				'downloadRequests'
			]
		])->mediaKits->pluck('downloadRequests')->flatten()/* ->groupBy('request_status') */;
	}

	public static function isAllowedToRespond($handlingRequest = 1)
	{
		$allowedLimit = DownloadController::getAllowedDownloadRequest();
		if($allowedLimit == -1){
			return true;
		}
		$alreadyResponded = DownloadController::getTotalRequest()->where('request_status', '!=', RequestStatusEnum::PENDING)->count();
		// dd($allowedLimit, $alreadyResponded, $handlingRequest);
		return ($allowedLimit >= ($alreadyResponded + $handlingRequest)) ? true : false;
	}
}
