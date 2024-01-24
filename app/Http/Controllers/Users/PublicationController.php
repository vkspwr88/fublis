<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PublicationController extends Controller
{
    public static function search($field, $string){
		return Publication::with('location')
							->where($field, 'like', '%' . $string . '%')
							->orderBy('name', 'desc')
							->get();
	}

	public static function createPublication($details)
	{
		$details = Arr::add(
							$details,
							'slug',
							PublicationController::generateSlug($details['name'])
						);
		return Publication::create($details);
	}

	public static function generateSlug($name)
	{
		$count = Publication::where('name', $name)->count();
		if($count > 0){
			$name .= $count;
		}
		return str()->replace(
							' ',
							'-',
							str()->headline($name)
						);
	}

	public static function findById(string $id)
	{
		return Publication::find($id);
	}

	public static function getAll()
	{
		return Publication::all();
	}

	public static function getAllPublications($journalist)
	{
		return $journalist->publications->concat($journalist->associatedPublications);
	}

	public static function loadModel($publication)
	{
		return $publication->load([
			'profileImage',
			'categories',
			'publicationTypes',
			'location',
			'publishFrom',
			'languages'
		]);
	}
}
