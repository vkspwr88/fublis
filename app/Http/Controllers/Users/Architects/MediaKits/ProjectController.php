<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Architects\MediaKitController as ArchitectsMediaKitController;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.projects.view', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'project'),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		ArchitectsMediaKitController::check($mediaKit);
		return view('users.pages.architects.media-kits.projects.edit', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'project'),
		]);
	}
}
