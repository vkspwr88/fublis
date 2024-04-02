<?php

namespace App\Http\Controllers\Users\Architects\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
	{
		if(!session()->has('url.intended')){
            session(['url.intended' => url()->previous()]);
        }
		return view('users.pages.architects.auth.login');
	}
}
