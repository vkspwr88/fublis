<?php

namespace App\Http\Controllers\Users\Journalists\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index(string $token, string $email)
	{
		return view('users.pages.journalists.auth.reset-password', [
			'token' => $token,
			'email' => $email,
		]);
	}
}
