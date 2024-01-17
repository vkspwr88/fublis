<?php

namespace App\Http\Controllers\Users\Journalists\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index(string $step = 'journalist-signup-step')
	{
		$initialState = session()->has('initial_state') ? session()->get('initial_state') : [];
		return view('users.pages.journalists.auth.signup', [
			'step' => $step,
			'initialState' => $initialState
		]);
	}
}
