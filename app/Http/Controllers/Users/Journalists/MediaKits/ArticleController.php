<?php

namespace App\Http\Controllers\Users\Journalists\MediaKits;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
		return view('users.pages.journalists.media-kits.articles.view', [
			'mediaKit' => $this->loadModel($mediaKit),
		]);
	}

	public function loadModel($mediaKit)
	{
		return $mediaKit->load([
			'story.images',
			'category',
			'architect' => [
				'company',
				'user',
				'position'
			]
		]);
	}
}
