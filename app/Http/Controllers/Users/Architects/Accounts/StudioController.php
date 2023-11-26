<?php

namespace App\Http\Controllers\Users\Architects\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\CompanyController;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
	{
		/* $brand = Company::whereHas('architects', function (Builder $query) {
							$query->where('user_id', auth()->id());
						})->first();
		//dd($brand);
		if(!$brand){
			return abort(404);
		}
		$brand = CompanyController::loadModel($brand);
		//dd($brand->mediaKits->paginate(2));
		return view('users.pages.architects.accounts.studio.index', [
			'brand' => $brand,
			'mediaKits' => $brand->mediaKits->sortByDesc('created_at')->paginate(1),
			'tags' => CompanyController::loadTags($brand),
		]); */
		return view('users.pages.architects.accounts.studio.index', [
			'brand' => CompanyController::getArchitectCompany(auth()->id()),
		]);
	}

	public function other()
	{
		$brand = Company::whereHas('architects', function (Builder $query) {
							$query->where('user_id', auth()->id());
						})->first();
		//dd($brand);
		if(!$brand){
			return abort(404);
		}
		$brand = CompanyController::loadModel($brand);

		return view('users.pages.architects.accounts.studio.other', [
			'brand' => $brand,
			'tags' => CompanyController::loadTags($brand),
		]);
	}
}
