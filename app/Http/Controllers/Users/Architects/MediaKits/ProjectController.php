<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		//dd($this->loadModel($mediaKit));
		return view('users.pages.architects.media-kits.projects.view', [
			'mediaKit' => $this->loadModel($mediaKit),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		return view('users.pages.architects.media-kits.projects.edit', [
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
