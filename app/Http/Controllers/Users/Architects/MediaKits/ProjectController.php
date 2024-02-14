<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		// dd(MediaKitController::loadModel($mediaKit, 'project'));
		if(!$mediaKit){
			return abort(404);
		}
		return view('users.pages.architects.media-kits.projects.view', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'project'),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		if($mediaKit->architect_id != auth()->user()->architect->id){
			return abort(401);
		}
		return view('users.pages.architects.media-kits.projects.edit', [
			'mediaKit' => MediaKitController::loadModel($mediaKit, 'project'),
		]);
	}
}
