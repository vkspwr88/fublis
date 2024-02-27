<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\TopPublication;
use Illuminate\Http\Request;

class TopPublicationController extends Controller
{
	public static function getAll()
	{
		// dd(TopPublication::all());
		return TopPublication::all()->sortBy('list_type');
	}

	public static function getTopPublicationRecord(array $details)
	{
		return TopPublication::where($details)->first();
	}

    public function top100(string $categorySlug, string $countrySlug)
	{
		$top100Publication = TopPublicationController::getTopPublicationRecord([
			'category_slug' => $categorySlug,
			'location_slug' => $countrySlug,
		]);
		/* if(!$top100Publication){
			return abort(404);
		} */
		return view('users.pages.top-100-publications', [
			'topPublication' => $top100Publication,
		]);
	}
}
