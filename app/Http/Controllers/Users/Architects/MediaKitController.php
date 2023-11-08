<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.media-kits.index');
	}

	public function view(MediaKit $mediaKit)
	{
		if (str()->contains($mediaKit->story_type, 'PressRelease')){
			return to_route('architect.media-kit.press-release.view', ['mediaKit' => $mediaKit->id]);
		}
		if (str()->contains($mediaKit->story_type, 'Article')){
			return to_route('architect.media-kit.article.view', ['mediaKit' => $mediaKit->id]);
		}
		if (str()->contains($mediaKit->story_type, 'Project')){
			return to_route('architect.media-kit.project.view', ['mediaKit' => $mediaKit->id]);
		}
	}
}
