<?php

namespace App\Http\Controllers\Users\Journalists\Accounts\Profile;

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
		return view('users.pages.journalists.accounts.profile.journalists.index');
	}

    public function view(Journalist $journalist)
	{
		if(!$journalist){
			return abort(404);
		}
		$journalist = UsersJournalistController::loadModel($journalist);
		$publications = PublicationController::getAllPublications($journalist);
		$categories = CategoryController::getPublicationsCategories($publications);
		return view('users.pages.journalists.accounts.profile.journalists.view', [
			'journalist' => $journalist,
			'categories' => $categories,
		]);
	}
}
