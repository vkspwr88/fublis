<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\MediaKitController;
use App\Models\Architect;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
	{
		$architect = Architect::where('user_id', auth()->id())
								->first();
		//dd($brand);
		if(!$architect){
			return abort(404);
		}
		$architect = ArchitectController::loadModel($architect);
		return view('users.pages.architects.accounts.profile.index', [
			'architect' => $architect,
		]);
	}

	public function analytic()
	{
		return view('users.pages.architects.accounts.profile.analytic', [
			'mediaKits' => MediaKitController::getUserMediaKitsAnalytics(auth()->id()),
		]);
	}

	public function alert()
	{
		return view('users.pages.architects.accounts.profile.alert');
	}

	public function notification()
	{
		return view('users.pages.architects.accounts.profile.notification');
	}

	public function message()
	{
		return view('users.pages.architects.accounts.profile.message');
	}

	public function inviteColleague()
	{
		return view('users.pages.architects.accounts.profile.invite-colleague');
	}
}
