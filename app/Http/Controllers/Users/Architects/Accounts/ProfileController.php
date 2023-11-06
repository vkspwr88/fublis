<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.accounts.settings.index');
	}

	public function analytic()
	{
		return view('users.pages.architects.accounts.settings.analytic');
	}

	public function alert()
	{
		return view('users.pages.architects.accounts.settings.alert');
	}

	public function notification()
	{
		return view('users.pages.architects.accounts.settings.notification');
	}

	public function message()
	{
		return view('users.pages.architects.accounts.settings.message');
	}

	public function inviteColleague()
	{
		return view('users.pages.architects.accounts.settings.invite-colleague');
	}
}
