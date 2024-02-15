<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public static function getAll()
	{
		return Area::all();
	}

	public static function findById(string $id)
	{
		return Area::find($id);
	}
}
