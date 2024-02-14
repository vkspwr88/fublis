<?php

namespace App\Http\Controllers\Users\Architects\AddStories;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Models\MediaKitDraft;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.add-stories.projects.index');
	}

	public function draft(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
	}

	public function preview(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
	}
}
