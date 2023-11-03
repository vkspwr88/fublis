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
		return view('users.pages.architects.pitch-story.publication.view');
	}
}
