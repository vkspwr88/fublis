<?php

namespace App\Http\Controllers\Users\Journalists\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
	{
		/* $architect = Architect::where('user_id', auth()->id())
								->first();
		//dd($brand);
		if(!$architect){
			return abort(404);
		}
		$architect = ArchitectController::loadModel($architect); */
		return view('users.pages.journalists.accounts.profile.index', [
			'architect' => [],
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
