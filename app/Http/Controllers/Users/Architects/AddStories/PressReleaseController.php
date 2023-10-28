<?php

namespace App\Http\Controllers\Users\Architects\AddStories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function index(){
		return view('users.pages.architects.add-stories.press-release');
	}

	public function success(){
		return view('users.pages.architects.add-stories.press-release-success');
	}
}
