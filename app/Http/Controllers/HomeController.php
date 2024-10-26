<?php

namespace App\Http\Controllers;

use App\Services\AffiliateService;
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
			$affList = AffiliateService::getAffListByUsername($request->ref);
			if($affList){
				$affVisit = $affList->affVisits()->create([
					'campaign' => $request->campaign ?? null,
					'ip_address' => $request->ip() ?? null,
				]);
				Session::put('aff_list_id', $affList->id);
				Session::put('aff_visit_id', $affVisit->id);
			}
		}
		return view('users.pages.home');
	}
}
