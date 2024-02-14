<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use App\Models\MediaKitDraft;
use Illuminate\Http\Request;

class AddStoryController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.add-stories.index');
	}

	public function success()
	{
		return view('users.pages.architects.add-stories.success');
	}
}
