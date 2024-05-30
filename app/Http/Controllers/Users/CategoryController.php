<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function getAll()
	{
		return Category::all();
	}

	public static function findById(string $id)
	{
		return Category::find($id);
	}

	public static function getPublicationsCategories($publications)
	{
		return Category::whereHas('publications', function (Builder $query) use($publications) {
			$query->whereIn('id', $publications->pluck('id'));
		})->get();
	}

	public static function getSelected($type, $owned = false)
	{
		if($type == 'journalist' || $type == 'publication'){
			return Category::has('publications')
									->orderBy('name', 'asc')
									->get();
		}
		if($type == 'mediakit'){
			if($owned){
				return Category::whereHas('mediaKits', function (Builder $query) {
					$query->where('architect_id', auth()->user()->architect->id);
				})->orderBy('name', 'asc')
				->get();
			}
			return Category::has('mediaKits')
							->orderBy('name', 'asc')
							->get();
		}
		if($type == 'company'){
			return Category::has('companies')
							->orderBy('name', 'asc')
							->get();
		}
		if($type == 'call'){
			// dd(Call::with('publication.publicationTypes')->get()->pluck('publication')->pluck('publicationTypes')->flatten()->unique()->pluck('id')/* where('submission_end_date', '>', Carbon::now()) */);
			return Category::has(['publication', 'journalist', 'language', 'location'])
							->whereHas('calls', function (Builder $query) {
								$query->where('submission_end_date', '>', Carbon::now());
							})->orderBy('name', 'asc')
							->get();
		}
	}
}
