<?php

namespace App\Http\Controllers\Users\Architects\PitchStories;

use App\Http\Controllers\Controller;
use App\Models\Journalist;
use Illuminate\Http\Request;

class JournalistController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.pitch-story.journalist.index');
	}

	public function view(Journalist $journalist)
	{
		$journalist->load([
			'user',
			'profileImage',
			'language',
			'location',
			'publications' => [
				'profileImage'
			],
			'associatedPublications' => [
				'profileImage'
			],
		]);
		return view('users.pages.architects.pitch-story.journalist.view', [
			'journalist' => $journalist,
		]);
	}
}
