<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddStoryController extends Controller
{
    public function index(Request $request)
	{
		return view('users.pages.architects.add-stories.index');
	}

	public function success()
	{
		return view('users.pages.architects.add-stories.success');
	}
}
