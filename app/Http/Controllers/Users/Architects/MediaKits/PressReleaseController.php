<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Architects\MediaKitController as ArchitectsMediaKitController;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PressReleaseController extends Controller
{
    public function view(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.press-releases.view', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'press-release'),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]);
	}

	public function pdf(MediaKit $mediaKit)
	{
		$mediaKit = MediaKitController::loadModel($mediaKit, 'press-release');
		$pdf = Pdf::loadView('users.pages.architects.media-kits.press-releases.pdf', ['mediaKit' => $mediaKit]);
		return $pdf->download(
			ucfirst(str()->camel($mediaKit->slug)) . '-' . 'factfile' . '.pdf'
		);
	}

	public function edit(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::isAuthorized($mediaKit);
		return view('users.pages.architects.media-kits.press-releases.edit', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'press-release'),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]);
	}
}
