<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\BuildingTypology;
use Illuminate\Http\Request;

class BuildingTypologyController extends Controller
{
    public static function getAll()
	{
		return BuildingTypology::all();
	}
}
