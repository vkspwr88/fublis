<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
	{
		if(isArchitect()){
			return to_route('architect.pitch-story.publications.index');
		}
		if(isJournalist()){
			return to_route('journalist.media-kit.index');
		}
		if(isAdmin()){
			return to_route('filament.backend.pages.dashboard');
		}
		// dd($request->all());
		// if($request->ref){
		// 	dd($request->ref);
		// }
		return view('users.pages.home');
	}
}
