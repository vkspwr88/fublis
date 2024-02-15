<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Architects\MediaKitController as ArchitectsMediaKitController;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.articles.view', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'article'),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.articles.edit', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'article'),
		]);
	}
}
