<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\AffiliateService;
use App\Services\AffListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

	public function aman()
	{
		$images = Image::where('imaggable_id', '9e9126ce-7a36-4a5b-b5fd-a17454bf8d8e')->get();
		foreach($images as $image) {
			echo Storage::url($image->image_path);
			echo '<br>';
			echo Storage::size($image->image_path);
			echo '<hr>';
		}
		phpinfo();
	}
}
