<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.accounts.profile.index');
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
