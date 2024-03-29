<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Architects\MediaKitController as ArchitectsMediaKitController;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function view(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.press-releases.view', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'press-release'),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::isAuthorized($mediaKit);
		return view('users.pages.architects.media-kits.press-releases.edit', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'press-release'),
		]);
	}
}
