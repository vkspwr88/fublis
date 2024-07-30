<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Architects\MediaKitController as ArchitectsMediaKitController;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ArticleController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.articles.view', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'article'),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]);
	}

	public function pdf(MediaKit $mediaKit)
	{
		$mediaKit = MediaKitController::loadModel($mediaKit, 'article');
		$pdf = Pdf::loadView('users.pages.architects.media-kits.articles.pdf', ['mediaKit' => $mediaKit]);
		return $pdf->download(
			ucfirst(str()->camel($mediaKit->slug)) . '-' . 'factfile' . '.pdf'
		);
	}

	public function edit(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.articles.edit', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'article'),
			'SEOData' => new SEOData(
                title: $mediaKit->story->title,
            ),
		]);
	}
}
