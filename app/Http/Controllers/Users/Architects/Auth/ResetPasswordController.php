<?php

namespace App\Http\Controllers\Users\Architects\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index(string $token, string $email)
	{
		return view('users.pages.architects.auth.reset-password', [
			'token' => $token,
			'email' => $email,
		]);
	}
}
