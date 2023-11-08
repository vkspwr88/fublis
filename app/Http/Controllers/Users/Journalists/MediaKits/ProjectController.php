<?php

namespace App\Http\Controllers\Users\Journalists\MediaKits;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		$mediaKit = $this->loadModel($mediaKit);
		NotificationService::sendViewCountNotification([
			'media_kit_id' => $mediaKit->id,
			'media_kit_title' => $mediaKit->story->title,
			'journalist_id' => auth()->id(),
			'journalist_name' => auth()->user()->name,
			'architect_user_id' => $mediaKit->architect->user_id,
		]);
		return view('users.pages.journalists.media-kits.projects.view', [
			'mediaKit' => $mediaKit,
		]);
	}

	public function loadModel($mediaKit)
	{
		return $mediaKit->load([
			'story' => [
				'photographs',
				'location',
				'siteAreaUnit',
				'builtUpAreaUnit',
				'projectStatus',
				'buildingTypology',
				'mediaContact',
				'projectAccess',
			],
			'category',
			'architect' => [
				'company',
				'user',
				'position'
			]
		]);
	}
}
