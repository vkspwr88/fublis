<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddStoryController extends Controller
{
    public function index(){
		return view('users.pages.architect.add-story.index');
	}

	public function success(){
		return view('users.pages.architect.add-story.success');
	}
}
