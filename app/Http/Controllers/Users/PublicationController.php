<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

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
		return Publication::create($details);
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
}
