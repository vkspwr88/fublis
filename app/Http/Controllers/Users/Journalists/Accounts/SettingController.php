<?php

namespace App\Http\Controllers\Users\Journalists\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function personalInfo()
	{
		return view('users.pages.journalists.accounts.settings.personal-info');
	}

	public function publication()
	{
		return view('users.pages.journalists.accounts.settings.publication');
	}

	public function password()
	{
		return view('users.pages.journalists.accounts.settings.password');
	}

	public function associatedPublication()
	{
		return view('users.pages.journalists.accounts.settings.associated-publication');
	}
}
