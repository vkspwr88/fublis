<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\MediaKitController;
use App\Http\Controllers\Users\NotificationController;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function index()
	{
		$architect = ArchitectController::getArchitect(auth()->id());
		//$architect = ArchitectController::loadModel($architect);
		return view('users.pages.architects.accounts.profile.index', [
			'architect' => $architect,
		]);
	}

	public function analytic()
	{
		return view('users.pages.architects.accounts.profile.analytic');
	}

	public function alert()
	{
		return view('users.pages.architects.accounts.profile.alert');
	}

	public function notification()
	{
		NotificationController::markAsRead();
		return view('users.pages.architects.accounts.profile.notification');
	}

	public function inviteColleague()
	{
		return view('users.pages.architects.accounts.profile.invite-colleague');
	}
}
