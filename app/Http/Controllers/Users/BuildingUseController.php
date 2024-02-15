<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\BuildingUse;
use Illuminate\Http\Request;

class BuildingUseController extends Controller
{
    public static function getAllByTypologyId(string $typologyId)
	{
		return BuildingUse::where('building_typology_id', $typologyId)
							->orderBy('name')
							->get();
	}

	public static function findById(string $id)
	{
		return BuildingUse::find($id);
	}
}
