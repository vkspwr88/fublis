<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function personalInfo()
	{
		return view('users.pages.architects.accounts.settings.personal-info');
	}

	public function company()
	{
		return view('users.pages.architects.accounts.settings.company');
	}

	public function password()
	{
		return view('users.pages.architects.accounts.settings.password');
	}

	public function team()
	{
		return view('users.pages.architects.accounts.settings.team');
	}

	public function billing()
	{
		return view('users.pages.architects.accounts.settings.billing');
	}
}
