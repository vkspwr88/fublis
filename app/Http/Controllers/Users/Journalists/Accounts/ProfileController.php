<?php

namespace App\Http\Controllers\Users\Journalists\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistController;
use App\Http\Controllers\Users\PublicationController;
use App\Models\Journalist;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
	{
		$journalist = Journalist::where('user_id', auth()->id())
								->first();
		//dd($brand);
		if(!$journalist){
			return abort(404);
		}
		$journalist = JournalistController::loadModel($journalist);
		$publications = PublicationController::getAllPublications($journalist);
		//dd($publications);
		$categories = CategoryController::getPublicationsCategories($publications);
		return view('users.pages.journalists.accounts.profile.index', [
			'journalist' => $journalist,
			'categories' => $categories,
		]);
	}

	public function notification()
	{
		return view('users.pages.journalists.accounts.profile.notification');
	}

	public function message()
	{
		return view('users.pages.architects.accounts.profile.message');
	}

	public function inviteColleague()
	{
		return view('users.pages.journalists.accounts.profile.invite-colleague');
	}
}
