<?php

namespace App\Http\Controllers\Users\Journalists\MediaKits;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		return view('users.pages.journalists.media-kits.projects.view', [
			'mediaKit' => $this->loadModel($mediaKit),
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
