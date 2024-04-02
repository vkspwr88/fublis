<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\TopJournalist;
use Illuminate\Http\Request;

class TopJournalistController extends Controller
{
	public static function getAll()
	{
		// dd(TopPublication::all());
		return TopJournalist::all()->sortBy('list_type');
	}

	public static function getTopJournalistRecord(array $details)
	{
		return TopJournalist::where($details)->first();
	}

    public function top(string $categorySlug, string $countrySlug)
	{
		$top100Journalist = TopJournalistController::getTopJournalistRecord([
			'category_slug' => $categorySlug,
			'location_slug' => $countrySlug,
		]);
		return view('users.pages.top-100-journalists', [
			'topJournalist' => $top100Journalist,
		]);
	}
}
