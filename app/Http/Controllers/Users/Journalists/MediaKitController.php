<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public function index()
	{
		return view('users.pages.journalists.media-kits.index');
	}

	public function view(MediaKit $mediaKit)
	{
		if(isJournalist()){
			$data = session('type') && session('message') ? ['type' => session('type'), 'message' => session('message')] : [];
			if (str()->contains($mediaKit->story_type, 'PressRelease')){
				return to_route('journalist.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug])->with($data);
			}
			if (str()->contains($mediaKit->story_type, 'Article')){
				return to_route('journalist.media-kit.article.view', ['mediaKit' => $mediaKit->slug])->with($data);
			}
			if (str()->contains($mediaKit->story_type, 'Project')){
				return to_route('journalist.media-kit.project.view', ['mediaKit' => $mediaKit->slug])->with($data);
			}
		}

		if(isArchitect()){
			return to_route('architect.media-kit.view', ['mediaKit' => $mediaKit->slug]);
		}

		return abort(404);
	}
}
