<?php

namespace App\Http\Controllers\Users\Architects\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
	{
		return view('users.pages.architect.auth.signup');
	}
}
