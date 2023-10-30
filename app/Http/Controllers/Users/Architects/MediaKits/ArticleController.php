<?php

namespace App\Http\Controllers\Users\Architects\MediaKits;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function view(MediaKit $mediaKit)
	{
		return view('users.pages.architects.media-kits.articles.view', [
			'mediaKit' => $this->loadModel($mediaKit),
		]);
	}

	public function edit(MediaKit $mediaKit)
	{
		return view('users.pages.architects.media-kits.articles.edit', [
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
