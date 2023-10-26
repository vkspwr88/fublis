<?php

namespace App\Http\Controllers\Users\Architects\AddStory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function index(){
		return view('users.pages.architect.add-story.press-release');
	}

	public function success(){
		return view('users.pages.architect.add-story.press-release-success');
	}
}
