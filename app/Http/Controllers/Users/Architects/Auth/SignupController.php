<?php

namespace App\Http\Controllers\Users\Architects\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index(string $step = 'architect-signup-step')
	{
		return view('users.pages.architects.auth.signup', [
			'step' => $step
		]);
	}
}
