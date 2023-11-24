<?php

namespace App\Http\Controllers\Users\Architects\PitchStories;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistController as UsersJournalistController;
use App\Http\Controllers\Users\PublicationController;
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
		if(!$journalist){
			return abort(404);
		}
		$journalist = UsersJournalistController::loadModel($journalist);
		$publications = PublicationController::getAllPublications($journalist);
		$categories = CategoryController::getPublicationsCategories($publications);
		return view('users.pages.architects.pitch-story.journalist.view', [
			'journalist' => $journalist,
			'categories' => $categories,
		]);
	}
}
