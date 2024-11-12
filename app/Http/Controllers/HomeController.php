<?php

namespace App\Http\Controllers;

use App\Services\AffiliateService;
use App\Services\AffListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
		if($request->ref){
			AffListService::setSession($request);
		}
		return view('users.pages.home');
	}
}
