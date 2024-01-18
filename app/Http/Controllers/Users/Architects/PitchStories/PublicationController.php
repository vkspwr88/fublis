<?php

namespace App\Http\Controllers\Users\Architects\PitchStories;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.pitch-story.publication.index');
	}

	public function view(Publication $publication)
	{
		$publication->load([
			'profileImage',
			'location',
			'categories',
			'journalists' => [
				'profileImage',
				'user',
				'position',
			],
			'associatedJournalists' => [
				'profileImage',
				'user',
				'position',
			],
		]);
		return view('users.pages.architects.pitch-story.publication.view', [
			'publication' => $publication,
		]);
	}
}
