<?php

namespace App\Http\Controllers\Users\Architects\PitchStories;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.pitch-story.call.index');
	}

	public function view(Call $call)
	{
		return view('users.pages.architects.pitch-story.call.view');
	}
}
