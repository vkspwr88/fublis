<?php

namespace App\Http\Controllers\Users\Journalists\MediaKits;

set_time_limit(600);
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use App\Services\NotificationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PressReleaseController extends Controller
{
    public function view(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		$mediaKit = MediaKitController::loadModel($mediaKit, 'press-release');
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

		return view('users.pages.journalists.media-kits.press-releases.view', [
			'mediaKit' => $mediaKit,
			'downloadRequest' => $mediaKit->downloadRequests->where('requested_by', auth()->id())->first(),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]);
	}

	public function pdf(MediaKit $mediaKit)
	{
		$pdf = Pdf::loadView('users.pages.journalists.media-kits.press-releases.pdf', ['mediaKit' => $mediaKit]);
		/* $pdf = Pdf::loadView('users.pages.journalists.media-kits.press-releases.view', [
			'mediaKit' => $mediaKit,
			'downloadRequest' => $mediaKit->downloadRequests->where('requested_by', auth()->id())->first(),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]); */
		return $pdf->download(
			ucfirst(str()->camel($mediaKit->slug)) . '-' . 'profile' . '.pdf'
		);
		/* Pdf::view('users.pages.journalists.media-kits.press-releases.pdf', ['mediaKit' => $mediaKit])
			->format('a4')
			->save(
				ucfirst(str()->camel($mediaKit->slug)) . '-' . 'profile' . '.pdf'
			); */
		/* Browsershot::url(route('journalist.media-kit.press-release.pdf', ['mediaKit' => $mediaKit->id]))
			->save(
				ucfirst(str()->camel($mediaKit->slug)) . '-' . 'profile' . '.pdf'
			); */
	}
}
