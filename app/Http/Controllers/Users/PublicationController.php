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
}
