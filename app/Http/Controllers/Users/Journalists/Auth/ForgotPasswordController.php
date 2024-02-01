<?php

namespace App\Http\Controllers\Users\Journalists\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index()
	{
		return view('users.pages.journalists.auth.forgot-password');
	}
}
