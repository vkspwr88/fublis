<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\JournalistPosition;
use Illuminate\Http\Request;

class JournalistPositionController extends Controller
{
    public static function getAll()
	{
		return JournalistPosition::all();
	}

	public static function getSelected($type)
	{
		if($type == 'journalist' || $type == 'publication'){
			return JournalistPosition::has('journalistPublications')
									->orderBy('name', 'asc')
									->get();
		}
	}

	public static function create($data)
	{
		return JournalistPosition::updateOrCreate($data);
	}
}
