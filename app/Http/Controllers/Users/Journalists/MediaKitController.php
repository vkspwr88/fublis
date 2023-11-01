<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public function index()
	{
		return view('users.pages.journalists.media-kits.index');
	}
}
