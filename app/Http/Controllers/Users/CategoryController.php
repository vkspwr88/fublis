<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
		}
		)->get();
	}

	public static function getSelected($type)
	{
		if($type == 'journalist' || $type == 'publication'){
			return Category::has('publications')
									->orderBy('name', 'asc')
									->get();
		}
		if($type == 'mediakit'){
			return Category::has('mediaKits')
							->orderBy('name', 'asc')
							->get();
		}
		if($type == 'company'){
			return Category::has('companies')
							->orderBy('name', 'asc')
							->get();
		}
	}
}
