<?php

namespace App\Http\Controllers\Users\Architects\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function index(Request $request)
	{
		Auth::logout();
		Session::flush();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return to_route('architect.login');
	}
}
