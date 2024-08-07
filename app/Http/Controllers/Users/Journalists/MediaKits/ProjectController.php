<?php

namespace App\Http\Controllers\Users\Journalists\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ProjectController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		$mediaKit = MediaKitController::loadModel($mediaKit, 'project');

		//dd($mediaKit->downloadRequests->where('requested_by', auth()->id())->first());
		if(auth()->user() && auth()->user()->journalist){
			NotificationService::sendViewCountNotification([
				'media_kit_id' => $mediaKit->id,
				'media_kit_slug' => $mediaKit->slug,
				'media_kit_title' => $mediaKit->story->title,
				'journalist_id' => auth()->id(),
				'journalist_slug' => auth()->user()->journalist->slug,
				'journalist_name' => auth()->user()->name,
				'architect_user_id' => $mediaKit->architect->user_id,
			]);
		}

		return view('users.pages.journalists.media-kits.projects.view', [
			'mediaKit' => $mediaKit,
			'downloadRequest' => $mediaKit->downloadRequests->where('requested_by', auth()->id())->first(),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]);
	}

	public function pdf(MediaKit $mediaKit)
	{
		$mediaKit = MediaKitController::loadModel($mediaKit, 'project');
		$pdf = Pdf::loadView('users.pages.journalists.media-kits.projects.pdf', ['mediaKit' => $mediaKit]);
		return $pdf->download(
			ucfirst(str()->camel($mediaKit->slug)) . '-' . 'factfile' . '.pdf'
		);
	}
}
