<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.accounts.settings.index');
	}
}
