<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function view(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		return view('users.pages.architects.media-kits.press-releases.view', [
			'mediaKit' => $this->loadModel($mediaKit),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		return view('users.pages.architects.media-kits.press-releases.edit', [
			'mediaKit' => $this->loadModel($mediaKit),
		]);
	}

	public function loadModel($mediaKit)
	{
		return $mediaKit->load([
			'story.photographs',
			'category',
			'architect' => [
				'company' => [
					'profileImage'
				],
				'profileImage',
				'user',
				'position'
			]
		]);
	}
}
