<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailPreferenceController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.email-preferences.index');
	}
}
