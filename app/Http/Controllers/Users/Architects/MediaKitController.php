<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public function index(){
		return view('users.pages.architects.media-kits.index');
	}
}
